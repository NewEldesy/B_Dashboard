<?php include_once('partials/header.php');?>

            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="row">
                            <div class="col-12 col-sm-6 text-center text-sm-start">
                                <h1 class="display-4">Profil</h1> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=profil&action=update" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Nom" class="form-label">Nom(s)</label>
                                    <input type="text" class="form-control" name="Nom" value="<?=$result['Nom'];?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Prenom" class="form-label">Prénom(s)</label>
                                    <input type="text" class="form-control" name="Prenom" value="<?=$result['Prenom'];?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Email" class="form-label">Adresse Mail</label>
                                    <input type="email" class="form-control" name="Email" value="<?=$result['Email'];?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Password" class="form-label">Mot de Passe Actuel</label>
                                    <input type="password" class="form-control" name="Password" value="<?=$result['Password'];?>" required>
                                </div>
                                <hr>
                                    <h5>Modifier Mot de Passe</h5>
                                <hr>
                                <div class="col-md-6 mb-3">
                                    <label for="pass1" class="form-label">Nouveau Mot de Passe</label>
                                    <input type="password" class="form-control" name="pass1" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pass2" class="form-label">Répétez Mot de Passe</label>
                                    <input type="password" class="form-control" name="pass2" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn btn-primary">Mettre à jour les informations de connexion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

<?php include_once('partials/footer.php');?>