<?php
    include_once('partials/header.php');
    
    if(doesIdExist('interventions', $_GET['id']) == false){
        header('location:index.php?page=intervention');
    }
?>
            

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Modifier Intervention</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                 
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <form action="index.php?page=intervention&action=update&id=<?=$result['id']?>" method="post">
                            <div class="row">
                                <input type="hidden" value="<?=$result['id'];?>" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="client_id" class="form-label">Client</label>
                                    <select class="form-select" name="client_id" value="<?= $result['client_id'];?>" aria-label="Floating label select example">
                                        <?php $clients = getClients();
                                            foreach($clients as $c) {
                                        ?>
                                        <option value="<?=$c['id'];?>" <?=($result['id']==$c['id']) ? 'selected' : '';?>><?=$c['prenom']. " " .$c['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_id" class="form-label">Service</label>
                                    <select class="form-select" name="client_id" value="<?= $result['client_id'];?>" aria-label="Floating label select example">
                                        <?php $service = getServices();
                                            foreach($service as $s) {
                                        ?>
                                        <option value="<?=$s['id'];?>" <?=($result['id']==$s['id']) ? 'selected' : '';?>><?=$s['libelle_services'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_intervention" class="form-label">Type Intervention</label>
                                    <input type="text" class="form-control" value="<?= $result['type_intervention'];?>" name="type_intervention">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_intervention" class="form-label">Description Intervention</label>
                                    <textarea class="form-control" aria-label="With textarea" name="description_intervention"><?=$result['description_intervention'];?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_intervention" class="form-label">Date Intervention</label>
                                    <input type="date" class="form-control" value="<?= $result['date_intervention'];?>" name="date_intervention">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cout_intervention" class="form-label">Cout Intervention</label>
                                    <input type="number" class="form-control" value="<?= $result['cout_intervention'];?>" name="cout_intervention">
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