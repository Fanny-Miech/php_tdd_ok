<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>donation</title>
</head>
<body>

    <h1>{{$project->title}}</h1>
    <h2>Détail des dons</h2>

    @foreach ($project->donations as $donation)
        <div>
            <h3>{{$donation->user->name}} : {{$donation->amount}} Euros</h3>
        </div>
    @endforeach

</body>
</html>