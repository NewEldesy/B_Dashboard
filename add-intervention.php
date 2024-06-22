<?php
    include_once('partials/header.php');
?>
            

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Ajout Interventions</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                 
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="add.php" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="intv_client" class="form-label">Sélectionnez un client</label>
                                    <select class="form-select" name="intv_client" aria-label="Floating label select example">
                                        <option value="1">Client 1</option>
                                        <option value="2">Client 2</option>
                                        <option value="3">Client 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intv_type" class="form-label">Types Interventions</label>
                                    <select class="form-select" name="intv_type" aria-label="Floating label select example">
                                        <option value="1">type 1</option>
                                        <option value="2">type 2</option>
                                        <option value="3">type 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="intv_description" class="form-label">Description Interventions</label>
                                    <textarea class="form-control" aria-label="With textarea" name="intv_description"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary col-2">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Form Page End -->

                <!-- Table Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded h-100 p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID Client</th>
                                        <th scope="col">Type Interventions</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="">Update</a>
                                            <a class="btn btn-sm btn-secondary" href="">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>mark@email.com</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="">Update</a>
                                            <a class="btn btn-sm btn-secondary" href="">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>jacob@email.com</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="">Update</a>
                                            <a class="btn btn-sm btn-secondary" href="">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Table End -->
                 
            </div>
            <!-- Blank End -->


<?php
    include_once('partials/footer.php');
?>