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
                        <div id="result"></div>
                        <form id="frm_add_user" class="needs-validation" novalidates>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="prest_client" class="form-label"></label>
                                    <select class="form-select" id="prest_client" aria-label="Floating label select example">
                                        <option value="1">Client 1</option>
                                        <option value="2">Client 2</option>
                                        <option value="3">Client 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intv_type" class="form-label">Type Prestations</label>
                                    <select class="form-select" id="intv_type">
                                        <option value="1">type 1</option>
                                        <option value="2">type 2</option>
                                        <option value="3">type 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prest_title" class="form-label"></label>
                                    <textarea class="form-control" id="prest_title">Description Interventions</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="prest_statut">Statut Prestations</label>
                                    <select class="form-select" id="prest_statut">
                                        <option value="1">Début</option>
                                        <option value="2">En Cours</option>
                                        <option value="3">Terminé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_title" class="form-label">Date Début</label>
                                    <input type="date" class="form-control" id="date_title" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_title" class="form-label">Date Fin</label>
                                    <input type="date" class="form-control" id="date_title" required>
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