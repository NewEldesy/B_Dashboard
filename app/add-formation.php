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
                            <table id="formation" class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Prix Formation</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; foreach($formations as $formation){ ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=$formation['nom']?></td>
                                        <td><?=$formation['description']?></td>
                                        <td><?=$formation['cout']?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=formation&action=update&id=<?=$formation['id']?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=formation&action=delete&id=<?=$formation['id']?>"><i class="fas fa-trash-alt"></i></a>
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

<script> new DataTable('#formation'); </script>