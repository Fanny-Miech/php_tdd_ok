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
        <h2>{{$project->title}}</h2>
        <p>{{$project->description}}</p>
        <h3>{{$project->user->name}}</h3>
        @auth
            <a href="/project/{{$project->id}}/edit">Editer</a>
            <br/><br/>
            <form action="/project/{{$project->id}}" method="post">
                @csrf
                @method('delete')
                <button type="input"><h4>Supprimer</h4></button>
            </form>
            <br/><br/>
            <fieldset>
                <legend><h3>Faire un don</h3></legend>
                <form action="/project/{{$project->id}}/donation" method="post">
                    @csrf
                    <label>Montant en Euros</label><br/>
                    <select type="select" name="amount"> 
                        <option value='0'></option>      
                        <option value='10'>10</option>
                        <option value='20'>20</option>
                        <option value='30'>30</option>
                        <option value='40'>40</option>
                        <option value='50'>50</option>
                        <option value='100'>100</option>
                    </select>
                    <input type="hidden" name="project_id" value="{{$project->id}}"/>
                    <br/><br/>
                    <button type="submit" value="donation_register" class="btn btn-primary"><h4>Valider le don</h4></button>

                </form>

            </fieldset>                
        @endauth

        <br/><br/>
        <a href="/project/{{$project->id}}/donation">Voir les dons</a>
        
    </div>

</body>
</html>