<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>project</title>
</head>
<body>
    <h1>Détail du projet</h1>

    <div>
        <h2>{{$project->name}}</h2>
        <p>{{$project->description}}</p>
        <h3>{{$project->user->name}}</h3>
    </div>

</body>
</html>