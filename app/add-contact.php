<?php
    include_once('partials/header.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <!-- Title Page Start -->
    <div class="col-sm-12 col-xl">
        <div class="bg-light rounded h-100 p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    <h1 class="display-4">Nouveau Contact</h1>
                </div>
                <!-- <div class="col-12 col-sm-6 text-center text-sm-end">
                    <br>
                    <a class="btn btn-dark" target="_blank" href="index.php?page=contact&action=print">
                        <i class="fas fa-print"></i> Imprimer Liste Contacts
                    </a>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Title Page End -->
    <!-- Form Page Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div id="result"></div>
            <form action="index.php?page=contact&action=add" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="prenom" required>
                    </div>
                    <div id="number"></div>
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" name="telephone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="localite" class="form-label">Localité</label>
                        <input type="text" class="form-control" name="localite" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="commentaires" class="form-label">Commentaires</label>
                        <textarea class="form-control" name="commentaires"></textarea>
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
                <table id="contact" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col">Type Contact</th>
                            <th scope="col">Localité</th>
                            <th scope="col">Commentaires</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($contacts as $contact){ ?>
                        <tr>
                            <td><?=$contact['id']?></td>
                            <td><?=$contact['nom']?></td>
                            <td><?=$contact['prenom']?></td>
                            <td><?=$contact['telephone']?></td>
                            <td><?=$contact['type_contact']?></td>
                            <td><?=$contact['localite']?></td>
                            <td><?=$contact['commentaires']?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="index.php?page=contact&action=update&id=<?=$contact['id']?>"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-secondary" href="index.php?page=contact&action=delete&id=<?=$contact['id']?>"><i class="fas fa-trash-alt"></i></a>
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
<script> new DataTable('#contact'); </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const telephoneInput = document.querySelector('input[name="telephone"]');
    const numberDiv = document.getElementById('number');

    // Fonction pour vérifier l'existence du contact
    function checkIfContactExists() {
        const telephone = telephoneInput.value.trim();
        
        if (telephone.length > 0) {
            fetch('./controlers/check_contact.php?telephone=' + encodeURIComponent(telephone))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.exists) {
                        numberDiv.innerHTML = '<span class="text-danger">Numéro existant</span>';
                    } else {
                        numberDiv.innerHTML = '<span class="text-success">Numéro non enregistré</span>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    numberDiv.innerHTML = '<span class="text-danger">Erreur lors de la vérification</span>';
                });
        } else {
            numberDiv.innerHTML = '';
        }
    }

    // Vérifiez si le contact existe lorsque la valeur du téléphone change
    telephoneInput.addEventListener('input', checkIfContactExists);
});
</script>