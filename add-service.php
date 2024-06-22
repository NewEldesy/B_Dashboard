<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Ajout Services</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-6">
                                <!-- Form Start -->
                                <form id="frm_add_user" class="needs-validation" novalidates>
                                    <div class="row">
                                        <div class="col-md-9 mb-3">
                                            <label for="serv_title">Libellé Services</label>
                                            <input type="text" class="form-control" id="serv_title" required>
                                        </div>
                                        <div class="col-md-end-6 mb-3">
                                            <button type="submit" class="btn btn-primary col-2">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form End -->
                            </div>
                            <div class="col-6">
                                <!-- Table Start -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Libellé Services</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>John</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="">Update</a>
                                                    <a class="btn btn-sm btn-secondary" href="">Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Mark</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="">Update</a>
                                                    <a class="btn btn-sm btn-secondary" href="">Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Jacob</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary" href="">Update</a>
                                                    <a class="btn btn-sm btn-secondary" href="">Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Table End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


<?php
    include_once('partials/footer.php');
?>