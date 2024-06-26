<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Ajout Participants</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=participant&action=update&id=<?=$result['id']?>" method="post">
                            <div class="row">
                                <input type="hidden" value="<?=$result['id']?>" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Entrez Nom(s)</label>
                                    <input type="text" class="form-control" value="<?=$result['nom']?>" name="nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prenom" class="form-label">Entrez Prénom(s)</label>
                                    <input type="text" class="form-control" value="<?=$result['prenom']?>" name="prenom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="adresse" class="form-label">Entrez Adresse</label>
                                    <input type="text" class="form-control" value="<?=$result['adresse']?>" name="adresse" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ville" class="form-label">Entrez Ville</label>
                                    <input type="text" class="form-control" value="<?=$result['ville']?>" name="ville" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telephone" class="form-label">Entrez Téléphone</label>
                                    <input type="tel" class="form-control" value="<?=$result['telephone']?>" name="telephone" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary col-2">Mis à Jour</button>
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