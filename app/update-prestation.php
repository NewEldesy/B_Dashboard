<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Update Prestation identified by id</h1>
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
                                        <option value="1" <?php if($result['client_id']==1) echo'selected'; ?> >Client 1</option>
                                        <option value="2" <?php if($result['client_id']==2) echo'selected'; ?> >Client 2</option>
                                        <option value="3" <?php if($result['client_id']==3) echo'selected'; ?> >Client 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_prestation" class="form-label">Type Prestations</label>
                                    <select class="form-select" name="type_prestation">
                                        <option value="1" <?php if($result['type_prestation']==1) echo'selected'; ?> >type 1</option>
                                        <option value="2" <?php if($result['type_prestation']==2) echo'selected'; ?> >type 2</option>
                                        <option value="3" <?php if($result['type_prestation']==3) echo'selected'; ?> >type 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_prestation" class="form-label">Description Interventions</label>
                                    <textarea class="form-control" name="description_prestation"><?= $result['description_prestation']; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="statut_prestation">Statut Prestations</label>
                                    <select class="form-select" name="statut_prestation">
                                        <option value="1" <?php if($result['statut_prestation']==1) echo'selected';?> >Début</option>
                                        <option value="2" <?php if($result['statut_prestation']==2) echo'selected';?> >En Cours</option>
                                        <option value="3" <?php if($result['statut_prestation']==3) echo'selected';?> >Terminé</option>
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