<?php
    include_once('partials/header.php');

    if(doesIdExist('Formations', $_GET['id']) == false){
        header('location:index.php?page=formation');
    }
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Modifier Formation</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=formation&action=update&id=<?=$result['id']?>" method="post">
                            <div class="row">
                                <input type="hidden" value="<?=$result['id']?>" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="nom" class="form-label">Nommez Formation</label>
                                    <input type="text" class="form-control" value="<?=$result['nom']?>" name="nom" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description Formation</label>
                                    <input type="text" class="form-control" value="<?=$result['description']?>" name="description" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cout" class="form-label">Prix Formation</label>
                                    <input type="number" class="form-control" value="<?=$result['cout']?>" name="cout" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_debut" class="form-label">Date Début</label>
                                    <input type="date" class="form-control" value="<?=$result['date_debut']?>" name="date_debut" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_fin" class="form-label">Date Fin</label>
                                    <input type="date" class="form-control" value="<?=$result['date_fin']?>" name="date_fin" required>
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