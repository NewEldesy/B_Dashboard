<?php
    include_once('partials/header.php');
?>
            

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Nouvelle Intervention</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <br>
                <!-- Search Client Start -->
                <!-- <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <label for="client_search" class="form-label">Rechercher Client</label>
                        <input type="text" class="form-control" id="client_search" placeholder="Entrez le nom ou prénom du client">
                        <div id="client_list" class="list-group mt-2"></div>
                    </div>
                </div> -->
                <!-- Search Client End -->
                 
                <!-- Form Page Start -->
                 <!-- id="form-container" style="display: none;" -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <form action="index.php?page=intervention&action=add" method="post">
                            <div class="row">
                                <input type="hidden" value="" name="id">
                                <div class="col-md-6 mb-3">
                                    <label for="client_id" class="form-label">Sélectionnez un client</label>
                                    <select class="form-select" name="client_id" aria-label="Floating label select example">
                                        <?php $clients = getClients();
                                            foreach($clients as $c) {
                                        ?>
                                        <option value="<?=$c['id'];?>"><?=$c['prenom']. " " .$c['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="service_id" class="form-label">Choix Service</label>
                                    <select class="form-select" name="service_id" aria-label="Floating label select example">
                                        <?php $services = getServices();
                                            foreach($services as $s) {
                                        ?>
                                        <option value="<?=$s['id'];?>"><?=$s['libelle_services'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type_intervention" class="form-label">Types Interventions</label>
                                    <input type="text" class="form-control" name="type_intervention">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description_intervention" class="form-label">Description Interventions</label>
                                    <textarea class="form-control" aria-label="With textarea" name="description_intervention"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="date_intervention" class="form-label">Date Interventions</label>
                                    <input type="date" class="form-control" name="date_intervention">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cout_intervention" class="form-label">Couts Interventions</label>
                                    <input type="number" class="form-control" name="cout_intervention">
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
                            <table id="intervention" class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID Client</th>
                                        <th scope="col">ID Service</th>
                                        <th scope="col">Type Interventions</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date Int.</th>
                                        <th scope="col">Cout</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($interventions as $intervention) {?>
                                    <tr>
                                        <td><?=$intervention['id']?></td>
                                        <td><?=$intervention['client_id']?></td>
                                        <td><?=$intervention['service_id']?></td>
                                        <td><?=$intervention['type_intervention']?></td>
                                        <td><?=$intervention['description_intervention']?></td>
                                        <td><?=$intervention['date_intervention']?></td>
                                        <td><?=$intervention['cout_intervention']?> xof</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=intervention&action=update&id=<?=$intervention['id']?>"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=intervention&action=delete&id=<?=$intervention['id']?>"><i class="fas fa-trash-alt"></i></a>
                                            <!-- <a class="btn btn-sm btn-dark" target="_blank" href="index.php?page=intervention&action=print&id=<?=$intervention['id']?>"><i class="fas fa-print"></i></a> -->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Table End -->
                 
            </div>
            <!-- Blank End -->

            <?php include_once('partials/footer.php'); ?>
            <script> new DataTable('#intervention'); </script>

            <!-- <script>
                $(document).ready(function(){
                    // Gestion de la recherche de client
                    $('#client_search').on('input', function(){
                        var query = $(this).val();
                        if(query !== ''){
                            $.ajax({
                                url: 'search_client.php',
                                method: 'POST',
                                data: {query: query},
                                success: function(data){
                                    $('#client_list').html(data);
                                }
                            });
                        } else {
                            $('#client_list').html('');
                        }
                    });
                });

                // Fonction pour sélectionner un client
                function selectClient(id, name){
                    $('#client_search').val(name);
                    $('#client_list').html(''); // Cacher la liste après sélection
                    $('input[name="client_id"]').val(id); // Assigner l'ID du client sélectionné
                    $('#form-container').show(); // Afficher le formulaire de prestation
                }
            </script> -->