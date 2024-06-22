<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Update Client identified by id</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form id="frm_add_user" class="needs-validation" novalidates>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="client_name" class="form-label">Nom(s)</label>
                                    <input type="text" class="form-control" id="client_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_pname" class="form-label">Prénom(s)</label>
                                    <input type="text" class="form-control" id="client_pname" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_addresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="client_addresse" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_ville" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="client_ville" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_tel" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="date_tel" required>
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