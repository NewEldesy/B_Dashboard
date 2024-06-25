<?php
    include_once('partials/header.php');
?>
            

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Update Intervention identified by id</h1>
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
                                        <option value="1" <?php if($result['client_id']==1) echo'selected';?> >Client 1</option>
                                        <option value="2" <?php if($result['client_id']==2) echo'selected';?> >Client 2</option>
                                        <option value="3" <?php if($result['client_id']==3) echo'selected';?> >Client 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_intervention" class="form-label">Type Intervention</label>
                                    <select class="form-select" name="type_intervention" value="<?= $result['type_intervention'];?>" aria-label="Floating label select example">
                                        <option value="1" <?php if($result['type_intervention']==1) echo'selected';?> >type 1</option>
                                        <option value="2" <?php if($result['type_intervention']==2) echo'selected';?> >type 2</option>
                                        <option value="3" <?php if($result['type_intervention']==3) echo'selected';?> >type 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_intervention" class="form-label">Description Intervention</label>
                                    <textarea class="form-control" aria-label="With textarea" name="description_intervention"><?=$result['description_intervention'];?></textarea>
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