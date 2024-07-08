<?php
    include_once('partials/header.php');

    if(doesIdExist('prestations', $_GET['id']) == false){
        header('location:index.php?page=prestation');
    }
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Modifier Prestation</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <form action="index.php?page=prestation&action=update&id=<?=$result['id'];?>" method="post">
                            <div class="row">
                                <input type="hidden" value="<?=$result['id'];?>" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="client_id" class="form-label">Choix Client</label>
                                    <select class="form-select" name="client_id" aria-label="Floating label select example">
                                        <?php $clients = getClients();
                                            foreach($clients as $c) {
                                        ?>
                                        <option value="<?=$c['id'];?>" <?=($result['id']==$c['id']) ? 'selected' : '';?>><?=$c['prenom']. " " .$c['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_prestation" class="form-label">Type Prestations</label>
                                    <input type="text" class="form-control" value="<?= $result['type_prestation'];?>" name="type_prestation">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_prestation" class="form-label">Description Interventions</label>
                                    <textarea class="form-control" name="description_prestation"><?= $result['description_prestation']; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cout_prestation" class="form-label">Cout Interventions</label>
                                    <input type="number" class="form-control" value="<?= $result['cout_prestation'];?>" name="cout_prestation">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="statut_prestation">Statut Prestations</label>
                                    <select class="form-select" name="statut_prestation">
                                        <option value="début" <?=($result['statut_prestation']=='début') ? 'selected' : '';?>>Début</option>
                                        <option value="en cours" <?=($result['statut_prestation']=='en cours') ? 'selected' : '';?>>En Cours</option>
                                        <option value="terminé" <?=($result['statut_prestation']=='terminé') ? 'selected' : '';?>>Terminé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_debut_prestation" class="form-label">Date Début</label>
                                    <input type="date" class="form-control" value="<?=$result['date_debut_prestation'];?>" name="date_debut_prestation" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_fin_prestation" class="form-label">Date Fin</label>
                                    <input type="date" class="form-control" value="<?=$result['date_fin_prestation'];?>" name="date_fin_prestation" required>
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