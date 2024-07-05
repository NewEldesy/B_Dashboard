<?php
    include_once('partials/header.php');

    if(doesIdExist('FormationParticipantsDetails', $_GET['id']) == false){
        header('location:index.php?page=participant');
    }
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Modifier Participant</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <form action="index.php?page=participant&action=update&id=<?=$result['id']?>" method="post">
                            <div class="row">
                                <input type="hidden" value="<?=$result['id']?>" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="participant_nom" class="form-label">Entrez Nom(s)</label>
                                    <input type="text" class="form-control" value="<?=$result['participant_nom']?>" name="participant_nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_prenom" class="form-label">Entrez Prénom(s)</label>
                                    <input type="text" class="form-control" value="<?=$result['participant_prenom']?>" name="participant_prenom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_adresse" class="form-label">Entrez Adresse</label>
                                    <input type="text" class="form-control" value="<?=$result['participant_adresse']?>" name="participant_adresse" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_telephone" class="form-label">Entrez Téléphone</label>
                                    <input type="tel" class="form-control" value="<?=$result['participant_telephone']?>" name="participant_telephone" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="formation_id" class="form-label">Choix Formation</label>
                                    <select class="form-select" name="formation_id" aria-label="Floating label select example">
                                        <?php $formations = getFormation();
                                            foreach($formations as $f) {
                                        ?>
                                        <option value="<?=$f['id'];?>" <?=($result['formation_id']==$f['id']) ? 'selected' : '';?>><?=$f['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Statuts">Statut</label>
                                    <select class="form-select" name="Statuts">
                                        <option value="Payé" <?=($result['Statuts'] == 'Payé') ? 'selected' : '';?>>Payé</option>
                                        <option value="En attente" <?=($result['Statuts'] == 'En attente') ? 'selected' : '';?>>En attente</option>
                                        <option value="Réservé" <?=($result['Statuts'] == 'Réservé') ? 'selected' : '';?>>Réservé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="montant_paye" class="form-label">Montant Payer</label>
                                    <input type="number" class="form-control" value="<?=$result['montant_paye']?>" name="montant_paye" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" value="<?=$result['description']?>" name="description" required>
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