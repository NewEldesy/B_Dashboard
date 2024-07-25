<?php
    include_once('partials/header.php');
    include_once('model.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                <h1 class="display-4">Nouveau Service</h1> 
                            </div>
                            <!-- <div class="col-12 col-sm-6 text-center text-sm-end">
                                <br>
                                <a class="btn btn-dark" target="_blank" href="index.php?page=service&action=print">
                                    <i class="fas fa-print"></i> Imprimer Liste Services
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
                <!-- Title Page End -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-6">
                                <!-- Form Start -->
                                <form action="index.php?page=service&action=add" method="post">
                                    <div class="row">
                                        <div class="col-md-9 mb-3">
                                            <label for="libelle_services">Libellé Services</label>
                                            <input type="text" class="form-control" name="libelle_services" required>
                                        </div>
                                        <div class="col-md-end-6 mb-3">
                                            <button type="submit" class="btn btn-primary col-2">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form End -->
                            </div>
                            <div class="col-6">
                                <!-- Table Start -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Libellé Services</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($entities as $service) {?>
                                            <tr>
                                                <td><?=$service['id']?></td>
                                                <td><?=$service['libelle_services']?></td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="index.php?page=service&action=update&id=<?=$service['id']?>"><i class="fas fa-edit"></i>edit</a>
                                                    <a class="btn btn-sm btn-secondary" href="index.php?page=service&action=delete&id=<?=$service['id']?>"><i class="fas fa-trash-alt"></i>delete</a>
                                                    <!-- <a class="btn btn-sm btn-dark" target="_blank" href="index.php?page=service&action=print&id=<?=$service['id']?>"><i class="fas fa-print"></i>print</a> -->
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Table End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


<?php
    include_once('partials/footer.php');
?>