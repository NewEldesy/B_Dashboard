<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Nouvel Utilisateur</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=user&action=add" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Nom" class="form-label">Entrez Nom(s)</label>
                                    <input type="text" class="form-control" name="Nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Prenom" class="form-label">Entrez Prénom(s)</label>
                                    <input type="text" class="form-control" name="Prenom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Email" class="form-label">Entrez Email</label>
                                    <input type="email" class="form-control" name="Email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_user" class="form-label">User Level</label>
                                    <select class="form-select" name="type_user" aria-label="Floating label select example">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
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
                            <table id="user" class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom(s)</th>
                                        <th scope="col">Prénom(s)</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user){ ?>
                                    <tr>
                                        <td><?=$user['id']?></td>
                                        <td><?=$user['Nom']?></td>
                                        <td><?=$user['Prenom']?></td>
                                        <td><?=$user['Email']?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=user&action=update&id=<?=$user['id']?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=user&action=delete&id=<?=$user['id']?>"><i class="fas fa-trash-alt"></i></a>
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


            <?php include_once('partials/footer.php'); ?>
            <script> new DataTable('#user'); </script>