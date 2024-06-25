<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Update User identified by id</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <form  action="index.php?page=client&action=update&id=<?=$result['id'];?>" method="post">
                            <div class="row">
                                <input type="hidden" value="<?=$result['id'];?>" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="Nom" class="form-label">Nom(s)</label>
                                    <input type="text" class="form-control" value="<?=$result['Nom'];?>" name="nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Prenom" class="form-label">Prénom(s)</label>
                                    <input type="text" class="form-control" value="<?=$result['Prenom'];?>" name="prenom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="text" class="form-control" value="<?=$result['Email'];?>" name="adresse" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="password" class="form-control" value="<?=$result['Password'];?>" name="ville" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" value="<?=$result['Password'];?>" name="telephone" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary col-2">Mettre à Jour</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Form Page End -->
            </div>
            <!-- Blank End -->


<?php
    include_once('partials/footer.php');
?>