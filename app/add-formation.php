<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Nouvelle Formation</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=formation&action=add" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nommez Formation</label>
                                    <input type="text" class="form-control" name="nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description Formation</label>
                                    <input type="text" class="form-control" name="description" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cout" class="form-label">Prix Formation</label>
                                    <input type="number" class="form-control" name="cout" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_debut" class="form-label">Date Début</label>
                                    <input type="date" class="form-control" name="date_debut" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_fin" class="form-label">Date Fin</label>
                                    <input type="date" class="form-control" name="date_fin" required>
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
                                        <th scope="col">Nom</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Prix Formation</th>
                                        <th scope="col">Date Début</th>
                                        <th scope="col">Date Fin</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($entities as $formation){ ?>
                                    <tr>
                                        <td><?=$formation['id']?></td>
                                        <td><?=$formation['nom']?></td>
                                        <td><?=$formation['description']?></td>
                                        <td><?=$formation['cout']?></td>
                                        <td><?=$formation['date_debut']?></td>
                                        <td><?=$formation['date_fin']?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=formation&action=update&id=<?=$formation['id']?>"><i class="fas fa-edit"></i>edit</a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=formation&action=delete&id=<?=$formation['id']?>"><i class="fas fa-trash-alt"></i>delete</a>
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