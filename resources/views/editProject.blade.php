<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>add-project</title>
</head>
<body>

    <h1>Modifier le projet</h1>

    <div class="container">
        <form action="/project/{{$project->id}}" method="post">
            @csrf
            
            @method('put')
    
    
            <div class="form-group">
                <label for="inputName">Titre du projet</label>
                <input type="text" class="form-control" id="inputName" name="title" value="{{$project->title}}">
            </div>
    
            <div class="form-group">
                <label for="inputDescription">Description du projet</label>
                <textarea name="description" id="inputDescription" cols="30" rows="10" name="description" >{{$project->description}}</textarea>
            </div>
    
            <button type="submit" class="btn btn-primary">Modifier le projet</button>
        </form>
    
    
    </div>

</body>
</html>