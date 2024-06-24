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
                        <div id="result"></div>
                        <form action="" method="post">
                            <div class="row">
                                <input type="hidden" value="" name="intv_id">
                                <div class="col-md-6 mb-3">
                                    <label for="intv_client" class="form-label">Client</label>
                                    <select class="form-select" name="intv_client" aria-label="Floating label select example">
                                        <option value="1">Client 1</option>
                                        <option value="2">Client 2</option>
                                        <option value="3">Client 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intv_type" class="form-label">Type Intervention</label>
                                    <select class="form-select" name="intv_type" aria-label="Floating label select example">
                                        <option value="1">type 1</option>
                                        <option value="2">type 2</option>
                                        <option value="3">type 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intv_description" class="form-label">Description Intervention</label>
                                    <textarea class="form-control" aria-label="With textarea" name="intv_description"></textarea>
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