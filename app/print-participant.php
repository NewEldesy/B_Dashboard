<?php
    include_once('partials/header.php');
    $result = getParticipantById($_GET['id']);
    $dateToString = getCurrentDateTimeString();
    $currentdate = frenchDate();
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="col-xl">
                    <a data-mdb-ripple-init class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark">
                        <i class="fas fa-print text-primary"></i> Print
                    </a>
                    <a data-mdb-ripple-init class="btn btn-light text-capitalize" data-mdb-ripple-color="dark">
                        <i class="far fa-file-pdf text-danger"></i> Export
                    </a>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="container mb-5 mt-3">
                            <div class="row d-flex align-items-baseline">
                                <div class="col-xl-12">
                                    <img width="50" height="60" src="assets/img/logo_1.jpeg" alt="logo B'Tech Group sas">
                                    <p class="pt-0">B'tech Group sas</p>
                                </div>

                                <hr>
                            </div>

                            <div class="container">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h2>Payement Formation</h2>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-xl-8">
                                        <h5 class="text-muted">Client Information</h5>
                                        <ul class="list-unstyled">
                                            <li class="text-muted">Nom(s) & Prénom(s): <?=$result['participant_prenom'] . " " . $result['participant_nom'];?></li>
                                            <li class="text-muted">Adrese : <?=$result['participant_adresse']?></li>
                                            <li class="text-muted">Téléphone : (226)<?=$result['participant_telephone']?></li>
                                        </ul>
                                    </div>

                                    <div class="col-xl-4">
                                        <h5 class="text-muted">Invoice</h5>
                                        <ul class="list-unstyled">
                                            <li class="text-muted">Facture ID : #<?=$dateToString;?></li>
                                            <li class="text-muted">Creation Date : <?=$currentdate;?></li>
                                            <li class="text-muted">
                                                Status : <?=generateStatusLabel($result['Statuts']);?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                                <div class="row my-2 mx-1 justify-content-center">
                                    <table class="table table-striped table-borderless">
                                        <thead style="background-color:#84B0CA ;" class="text-white">
                                            <?php $f = getFormationById($result['formation_id']);?>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Formation</th>
                                                <th scope="col">Descrption formation</th>
                                                <th scope="col">Prix Formation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td><?=$f['nom'];?></td>
                                                <td><?=$f['description'];?></td>
                                                <td><?=$f['cout'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-xl-9">
                                        <!-- <p class="ms-3">Add additional notes and payment information</p> -->
                                    </div>

                                    <div class="col-xl-3">
                                        <ul class="list-unstyled">
                                            <li class="text-muted ms-3"><span class="text-black me-4">Total A Payer : </span><?=$f['cout'];?> XOF</li>
                                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Total Payer : </span><?=$result['montant_paye'];?> XOF</li>
                                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Reste Payer : </span><?=($f['cout'] - $result['montant_paye']);?> XOF</li>
                                        </ul>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-xl-10">
                                        <p>Montant restant Total_formation - Totalpayé = Total_restant</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


            
<?php
    include_once('partials/footer.php');
?>         