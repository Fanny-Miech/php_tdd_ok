<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>project</title>
</head>
<body>
    <h1>Liste des projets</h1>
    @foreach ($projects as $project)
    <div>
        <a href="/project/{{$project->id}}">
            <h2>{{$project->title}}</h2>
        </a>
        <p>{{$project->description}}</p>
        <br/>
    </div>
    @endforeach
</body>
</html>