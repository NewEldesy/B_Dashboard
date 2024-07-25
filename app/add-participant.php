<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Nouveau Participant</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=participant&action=add" method="post">
                        <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="participant_nom" class="form-label">Entrez Nom(s)</label>
                                    <input type="text" class="form-control" name="participant_nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_prenom" class="form-label">Entrez Prénom(s)</label>
                                    <input type="text" class="form-control" name="participant_prenom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_adresse" class="form-label">Entrez Adresse</label>
                                    <input type="text" class="form-control" name="participant_adresse" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_telephone" class="form-label">Entrez Téléphone</label>
                                    <input type="tel" class="form-control" name="participant_telephone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="formation_id" class="form-label">Choix Formation</label>
                                    <select class="form-select" name="formation_id" aria-label="Floating label select example">
                                        <?php $formations = getFormation();
                                            foreach($formations as $f) {
                                        ?>
                                        <option value="<?=$f['id'];?>"><?=$f['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Statuts">Statut</label>
                                    <select class="form-select" name="Statuts">
                                        <option value="Payé">Payé</option>
                                        <option value="En attente">En attente</option>
                                        <option value="Réservé">Réservé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="montant_paye" class="form-label">Montant Payer</label>
                                    <input type="number" class="form-control" name="montant_paye" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description Payement</label>
                                    <input type="text" class="form-control" name="description" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary col-2">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Form Page End -->

                <!-- Table Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom(s)</th>
                                        <th scope="col">Prénom(s)</th>
                                        <th scope="col">Adresse</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Formation</th>
                                        <th scope="col">Montant Payer</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Description Payement</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($entities as $p){ ?>
                                    <tr>
                                        <td><?=$p['id']?></td>
                                        <td><?=$p['participant_nom']?></td>
                                        <td><?=$p['participant_prenom']?></td>
                                        <td><?=$p['participant_adresse']?></td>
                                        <td><?=$p['participant_telephone']?></td>
                                        <td><?=$p['formation_id']?></td>
                                        <td><?=$p['montant_paye']?></td>
                                        <td><?=$p['Statuts']?></td>
                                        <td><?=$p['description']?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=participant&action=update&id=<?=$p['id']?>"><i class="fas fa-edit"></i>edit</a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=participant&action=delete&id=<?=$p['id']?>"><i class="fas fa-trash-alt">delete</i></a>
                                            <!-- <a class="btn btn-sm btn-dark" href="index.php?page=participant&action=print&id=<?=$p['id']?>"><i class="fas fa-print">print</i></a> -->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Table End -->
            </div>
            <!-- Blank End -->


<?php
    include_once('partials/footer.php');
?>