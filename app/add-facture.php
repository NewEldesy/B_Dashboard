<?php include_once('partials/header.php'); ?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start --> 
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Nouvelle Facture</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="row">
                            <div class="col-12">
                                <!-- Form Start -->
                                <form id="invoiceForm" action="index.php?page=facture&action=add" method="post">
                                    <div class="row">
                                        <h4>Client Information</h4>
                                        <br>
                                        <div class="col-md-6 mb-3">
                                            <label for="nom_entreprise" class="form-label">Nom Entreprise</label>
                                            <input type="text" class="form-control" name="nom_entreprise" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="client_adresse" class="form-label">Adresse</label>
                                            <input type="text" class="form-control" name="client_adresse" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="IFU" class="form-label">IFU</label>
                                            <input type="text" class="form-control" name="IFU" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="RCCM" class="form-label">RCCM</label>
                                            <input type="text" class="form-control" name="RCCM" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="divisionFiscale" class="form-label">Division Fiscale</label>
                                            <input type="text" class="form-control" name="divisionFiscale" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="client_téléphone" class="form-label">Téléphone</label>
                                            <input type="tel" class="form-control" name="client_téléphone" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><hr /></div>
                                        <h4>Facture Information</h4>
                                        <br>
                                        <div class="col-md-6 mb-3">
                                            <label for="objet_facture" class="form-label">Objet Facture</label>
                                            <input id="facture_date" type="text" class="form-control" name="objet_facture" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="statut">Statut</label>
                                            <select class="form-select" name="statut">
                                                <option value="payé">Non Payé</option>
                                                <option value="non payé">Payé</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"><hr /></div>
                                        <div class="col-md-4 mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" class="form-control" id="description">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="quantity" class="form-label">Quantité</label>
                                            <input type="number" class="form-control" id="quantity">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="pu" class="form-label">Prix Unitaire</label>
                                            <input type="number" class="form-control" id="pu">
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <br>
                                            <button type="button" id="add_to_list" class="btn btn btn-primary"><i class="fa fa-plus"></i>add</button>
                                        </div>

                                        <div class="row table-responsive">
                                            <table class="table table-striped table-bordered" id="itemList">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Quantité</th>
                                                        <th>P.U</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Les nouvelles lignes seront ajoutées ici -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-md-12"><hr></div>
                                    <input type="hidden" name="elements" id="elements">
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="submit" class="btn btn-primary col-2">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Entreprise</th>
                                        <th scope="col">Adresse</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">IFU</th>
                                        <th scope="col">RCCM</th>
                                        <th scope="col">Division Fiscale</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Date Emission</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($factures as $Facture){ ?>
                                    <tr>
                                        <td><?=$Facture['nFacture']?></td>
                                        <td><?=$Facture['nom_entreprise']?></td>
                                        <td><?=$Facture['client_adresse']?></td>
                                        <td><?=$Facture['client_telephone']?></td>
                                        <td><?=$Facture['IFU']?></td>
                                        <td><?=$Facture['RCCM']?></td>
                                        <td><?=$Facture['divisionFiscale']?></td>
                                        <td><?=$Facture['total_facture']?></td>
                                        <td><?= generateStatusLabel($Facture['statut']); ?></td>
                                        <td><?=$Facture['date_facture']?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=facture&action=update&id=<?=$Facture['nFacture']?>"><i class="fas fa-edit"></i>edit</a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=facture&action=delete&id=<?=$Facture['nFacture']?>"><i class="fas fa-trash-alt"></i>delete</a>
                                            <a class="btn btn-sm btn-dark" target="_blank" href="index.php?page=facture&action=print&id=<?=$Facture['nFacture']?>"><i class="fas fa-print"></i>print</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                <script>
                    var selectedRow = null;

                    document.getElementById("add_to_list").addEventListener("click", onFormSubmit);
                    document.getElementById("invoiceForm").addEventListener("submit", prepareData);

                    function onFormSubmit() {
                        var formData = readFormData();
                        if (selectedRow == null) {
                            insertNewRecord(formData);
                        } else {
                            updateRecord(formData);
                        }
                        resetForm();
                    }

                    function readFormData() {
                        var formData = {};
                        formData["description"] = document.getElementById("description").value;
                        formData["quantity"] = document.getElementById("quantity").value;
                        formData["pu"] = document.getElementById("pu").value;
                        formData["total"] = formData["quantity"] * formData["pu"];
                        return formData;
                    }

                    function insertNewRecord(data) {
                        var table = document.getElementById("itemList").getElementsByTagName('tbody')[0];
                        var newRow = table.insertRow(table.length);
                        var cell1 = newRow.insertCell(0);
                        cell1.innerHTML = data.description;
                        var cell2 = newRow.insertCell(1);
                        cell2.innerHTML = data.quantity;
                        var cell3 = newRow.insertCell(2);
                        cell3.innerHTML = data.pu;
                        var cell4 = newRow.insertCell(3);
                        cell4.innerHTML = data.total;
                        var cell5 = newRow.insertCell(4);
                        cell5.innerHTML = `<a href="#" onClick="onEdit(this)"><i class="fa fa-edit"></i></a>
                                            <a href="#" onClick="onDelete(this)"><i class="fa fa-trash"></i></a>`;
                    }

                    function resetForm() {
                        document.getElementById("description").value = "";
                        document.getElementById("quantity").value = "";
                        document.getElementById("pu").value = "";
                        selectedRow = null;
                    }

                    function onEdit(td) {
                        selectedRow = td.parentElement.parentElement;
                        document.getElementById("description").value = selectedRow.cells[0].textContent;
                        document.getElementById("quantity").value = selectedRow.cells[1].textContent;
                        document.getElementById("pu").value = selectedRow.cells[2].textContent;
                    }

                    function updateRecord(formData) {
                        selectedRow.cells[0].innerHTML = formData.description;
                        selectedRow.cells[1].innerHTML = formData.quantity;
                        selectedRow.cells[2].innerHTML = formData.pu;
                        selectedRow.cells[3].innerHTML = formData.total;
                    }

                    function onDelete(td) {
                        if (confirm('Are you sure you want to delete this record?')) {
                            var row = td.parentElement.parentElement;
                            document.getElementById("itemList").deleteRow(row.rowIndex);
                            resetForm();
                        }
                    }

                    function prepareData(event) {
                        var table = document.getElementById("itemList").getElementsByTagName('tbody')[0];
                        var rows = table.rows;
                        var elements = [];

                        for (var i = 0; i < rows.length; i++) {
                            var row = rows[i];
                            var element = {
                                description: row.cells[0].innerText,
                                quantite: row.cells[1].innerText,
                                prix_unitaire: row.cells[2].innerText,
                                total: row.cells[3].innerText
                            };
                            elements.push(element);
                        }

                        document.getElementById('elements').value = JSON.stringify(elements);
                    }
                </script>



<?php include_once('partials/footer.php'); ?>