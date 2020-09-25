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
        <h5>Bonjour {{$userName}},</h5>
        <br><br>
        <p> 
            Vous venez d'effectuer un don de {{ $donationAmount}} euros pour soutenir le projet {{$projectTitle}}.
        </p><br>
        <h6>Toute l'équipe de TDD vous en remercie.</h6>
        <p>Cordialement.</p>
        <br><br>
        <p>Cet email est envoyé automatiquement, merci de ne pas y répondre.</p>

    </div>
</body>
</html>