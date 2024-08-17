<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Recherche Client</h2>
    <input type="text" class="form-control" id="search" placeholder="Entrez le nom ou prénom du client">
    <div id="result" class="mt-3"></div>
</div>

<script>
    $(document).ready(function(){
        $('#search').on('input', function(){
            var search = $(this).val();
            if(search != ''){
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {search: search},
                    success: function(response){
                        $('#result').html(response);
                    }
                });
            } else {
                $('#result').html('');
            }
        });
    });
</script>
</body>
</html>
