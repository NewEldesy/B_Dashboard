<?php
    include_once('partials/header.php');
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <!-- Title Page Start -->
    <div class="col-sm-12 col-xl">
        <div class="bg-light rounded h-100 p-4">
            <h1 class="display-4">Modifier Fournisseur</h1>
        </div>
    </div>
    <!-- Title Page End -->
    <!-- Form Page Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <form action="index.php?page=fournisseur&action=update&id=<?=$result['id'];?>" method="post">
                <div class="row">
                    <input type="hidden" value="<?=$result['id'];?>" name="id">
                    <div class="col-md-6 mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" value="<?=$result['nom'];?>" name="nom" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" value="<?=$result['prenom'];?>" name="prenom" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="entreprise" class="form-label">Entreprise</label>
                        <input type="text" class="form-control" value="<?=$result['entreprise'];?>" name="entreprise" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="localite" class="form-label">Localité</label>
                        <input type="text" class="form-control" value="<?=$result['localite'];?>" name="localite" required>
                    </div>
                    <div id="fournisseur"></div>
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input type="text" class="form-control" value="<?=$result['telephone'];?>" name="telephone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Mail</label>
                        <input type="text" class="form-control" value="<?=$result['email'];?>" name="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type_Fournisseur" class="form-label">Type Fournisseur</label>
                        <input type="text" class="form-control" value="<?=$result['type_Fournisseur'];?>" name="type_Fournisseur" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="commentaires" class="form-label">Commentaires</label>
                        <textarea class="form-control" name="commentaires"><?=$result['commentaires'];?></textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const telephoneInput = document.querySelector('input[name="telephone"]');
    const numberDiv = document.getElementById('fournisseur');

    // Fonction pour vérifier l'existence du contact
    function checkIfContactExists() {
        const telephone = telephoneInput.value.trim();
        
        if (telephone.length > 0) {
            fetch('./controlers/check_fournisseur.php?telephone=' + encodeURIComponent(telephone))
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

<?php
    include_once('partials/footer.php');
?>