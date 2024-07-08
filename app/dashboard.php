<?php
    include_once('partials/header.php');
?>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <h4>Informations</h4>
                </div>
            </div>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-users fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Clients</p>
                                <h6 class="mb-0"><?=htmlspecialchars($client);?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-tag fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Interventions</p>
                                <h6 class="mb-0"><?=htmlspecialchars($intervention);?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-copy fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Prestations</p>
                                <h6 class="mb-0"><?=htmlspecialchars($prestation);?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-list fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Services</p>
                                <h6 class="mb-0"><?=htmlspecialchars($service);?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <h4>Couts</h4>
                </div>
            </div>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Prestation</p>
                                <h6 class="mb-0"><?=htmlspecialchars($coutPrestation);?> XOF</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Intervention</p>
                                <h6 class="mb-0"><?=htmlspecialchars($coutIntervention);?> XOF</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <h4>Formation</h4>
                </div>
            </div>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-chalkboard fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Formation Disponible</p>
                                <h6 class="mb-0"><?=htmlspecialchars($formationDispo);?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-user-graduate fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Participant</p>
                                <h6 class="mb-0"><?=htmlspecialchars($participant);?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fas fa-money-bill fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cout Formation</p>
                                <h6 class="mb-0"><?=htmlspecialchars($coutFormation);?> XOF</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <h4>Facture</h4>
                </div>
            </div>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-receipt fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Facture Payé</p>
                                <h6 class="mb-0">
                                    <?=htmlspecialchars($nbfPaye);?>
                                    <br><br>
                                    <?=htmlspecialchars($totalFPaye);?> XOF
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fa fa-receipt fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Facture Non Payé</p>
                                <h6 class="mb-0">
                                    <?=htmlspecialchars($nbfnPaye);?>
                                    <br><br>
                                    <?=htmlspecialchars($totalFNpaye);?> XOF
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-5">
                            <i class="fas fa-file-invoice-dollar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Facture</p>
                                <h6 class="mb-0">
                                    <?=htmlspecialchars($nbFacture);?>
                                    <br><br>
                                    <?=htmlspecialchars($totalFNpaye + $totalFPaye);?> XOF
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->

<?php
    include_once('partials/footer.php');
?>