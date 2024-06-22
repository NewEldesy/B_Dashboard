<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Ajout Clients</h1>
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
                                    <label for="client_name" class="form-label">Entrez Nom(s) Client(s)</label>
                                    <input type="text" class="form-control" name="client_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_pname" class="form-label">Entrez Prénom(s) Client(s)</label>
                                    <input type="text" class="form-control" name="client_pname" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_addresse" class="form-label">Entrez Adresse Client</label>
                                    <input type="text" class="form-control" name="client_addresse" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_ville" class="form-label">Entrez Ville Client</label>
                                    <input type="text" class="form-control" name="client_ville" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="client_tel" class="form-label">Entrez Téléphone Client</label>
                                    <input type="tel" class="form-control" name="client_tel" required>
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
                                        <th scope="col">Nom(s)</th>
                                        <th scope="col">Prénom(s)</th>
                                        <th scope="col">Adresse</th>
                                        <th scope="col">Ville</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>John</td>
                                        <td>Doe</td>
                                        <td>jhon@email.com</td>
                                        <td>USA</td>
                                        <td>123</td>
                                        <td>Member</td>
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
                                        <td>UK</td>
                                        <td>456</td>
                                        <td>Member</td>
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
                                        <td>AU</td>
                                        <td>789</td>
                                        <td>Member</td>
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