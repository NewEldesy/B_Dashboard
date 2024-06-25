<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Ajout Prestations</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=prestation&action=add" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="client_id" class="form-label"></label>
                                    <select class="form-select" name="client_id" aria-label="Floating label select example">
                                        <option value="1">Client 1</option>
                                        <option value="2">Client 2</option>
                                        <option value="3">Client 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_prestation" class="form-label">Type Prestations</label>
                                    <select class="form-select" name="type_prestation">
                                        <option value="1">type 1</option>
                                        <option value="2">type 2</option>
                                        <option value="3">type 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_prestation" class="form-label">Description Interventions</label>
                                    <textarea class="form-control" name="description_prestation"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cout_prestation" class="form-label">Cout Interventions</label>
                                    <input type="number" class="form-control" value="<?= $result['cout_prestation'];?>" name="cout_prestation">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="statut_prestation">Statut Prestations</label>
                                    <select class="form-select" name="statut_prestation">
                                        <option value="1">Début</option>
                                        <option value="2">En Cours</option>
                                        <option value="3">Terminé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_debut_prestation" class="form-label">Date Début</label>
                                    <input type="date" class="form-control" name="date_debut_prestation" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_fin_prestation" class="form-label">Date Fin</label>
                                    <input type="date" class="form-control" name="date_fin_prestation" required>
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
                                        <th scope="col">ID Client</th>
                                        <th scope="col">Type Prestations</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Cout</th>
                                        <th scope="col">Date Start</th>
                                        <th scope="col">Date End</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($entities as $prestation) {
                                        $statusLabels = [ 1 => 'Début', 2 => 'En Cours', 3 => 'Terminé' ]; 
                                    ?>
                                    <tr>
                                        <td><?=$prestation['id']?></td>
                                        <td><?=$prestation['client_id']?></td>
                                        <td><?=$prestation['type_prestation']?></td>
                                        <td><?=$prestation['description_prestation']?></td>
                                        <td><?=$prestation['cout_prestation']?> xof</td>
                                        <td><?=$prestation['date_debut_prestation']?></td>
                                        <td><?=$prestation['date_fin_prestation']?></td>
                                        <td>
                                            <?= isset($statusLabels[$prestation['statut_prestation']]) ? htmlspecialchars($statusLabels[$prestation['statut_prestation']]) : 'Inconnu'; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=prestation&action=update&id=<?=$prestation['id']?>">Update</a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=prestation&action=delete&id=<?=$prestation['id']?>">Delete</a>
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