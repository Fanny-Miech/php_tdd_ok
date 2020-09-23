<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add-project</title>
</head>
<body>

    <h1>Ajouter un projet</h1>

    <div class="container">

        {{-- question sur la route ?? --}}
        <form action='/project' method="post">
            @csrf
            <div class="form-group">
                <label for="inputName">Titre du projet</label>
                <input type="text" class="form-control" id="inputName" name="title">
            </div>
            <br/>
    
            <div class="form-group">
                <label for="inputDescription">Description du projet</label>
                <textarea type="description" id="inputDescription" name="description"></textarea>
            </div>
       
        <br/>
            <button type="submit" value="Register" class="btn btn-primary">Ajouter le projet</button>
        </form>

    </div>

</body>
</html>