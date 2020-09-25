<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>email</title>
</head>
<body>
    <div>
        <h5>Bonjour {{$authorName}},</h5>
        <br><br>
        <p> 
        {{$userName}} vient d'effectuer un don de {{ $donationAmount}} euros pour soutenir votre projet {{$projectTitle}}.
        </p><br>
        <p>Cordialement, <br>
        L'équipe de TDD.</p>
        <br><br>
        <p>Cet email est envoyé automatiquement, merci de ne pas y répondre.</p>

    </div>
</body>
</html>