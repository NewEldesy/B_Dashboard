<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Update Inscription</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=inscription&action=update&id=<?=$result['id']?>" method="post">
                            <div class="row">
                                <input type="hidden"  value="<?=$result['id']?>" name="id">
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
                                    <label for="participant_id" class="form-label">Choix Participant</label>
                                    <select class="form-select" name="participant_id">
                                        <?php $participants = getParticipant();
                                            foreach($participants as $p) {
                                        ?>
                                        <option value="<?=$p['id'];?>" <?=($result['participant_id']==$p['id']) ? 'selected' : '';?>><?=$p['prenom']. " " .$p['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status">Statut</label>
                                    <select class="form-select" name="status">
                                        <option value="payé" <?=($result['status'] == 'payé') ? 'selected' : '';?>>Payé</option>
                                        <option value="réservé" <?=($result['status'] == 'réservé') ? 'selected' : '';?>>Réservé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description Statut</label>
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