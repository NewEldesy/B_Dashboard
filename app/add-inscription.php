<?php
    include_once('partials/header.php');
?>


            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Title Page Start -->
                <div class="col-sm-12 col-xl">
                    <div class="bg-light rounded h-100 p-4">
                        <h1 class="display-4">Inscription Participant</h1>
                    </div>
                </div>
                <!-- Title Page End -->
                <!-- Form Page Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light rounded-top p-4">
                        <div id="result"></div>
                        <form action="index.php?page=inscription&action=add" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="formation_id" class="form-label">Choix Formation</label>
                                    <select class="form-select" name="formation_id" aria-label="Floating label select example">
                                        <?php $formations = getFormation();
                                            foreach($formations as $f) {
                                        ?>
                                        <option value="<?=$f['id'];?>"><?=$f['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="participant_id" class="form-label">Choix Participant</label>
                                    <select class="form-select" name="participant_id">
                                        <?php $participants = getParticipant();
                                            foreach($participants as $p) {
                                        ?>
                                        <option value="<?=$p['id'];?>"><?=$p['prenom']. " " .$p['nom'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status">Statut</label>
                                    <select class="form-select" name="status">
                                        <option value="payé">Payé</option>
                                        <option value="réservé">Réservé</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description Statut</label>
                                    <input type="text" class="form-control" name="description" required>
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
                                        <th scope="col">ID Formation</th>
                                        <th scope="col">ID Participants</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($entities as $inscription) { ?>
                                    <tr>
                                        <td><?=$inscription['id']?></td>
                                        <td><?=$inscription['formation_id']?></td>
                                        <td><?=$inscription['participant_id']?></td>
                                        <td><?=$inscription['status']?></td>
                                        <td><?=$inscription['description']?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="index.php?page=inscription&action=update&id=<?=$inscription['id']?>">Update</a>
                                            <a class="btn btn-sm btn-secondary" href="index.php?page=inscription&action=delete&id=<?=$inscription['id']?>">Delete</a>
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


<?php
    include_once('partials/footer.php');
?>