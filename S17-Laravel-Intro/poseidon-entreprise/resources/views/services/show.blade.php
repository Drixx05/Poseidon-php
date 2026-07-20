<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche service</title>
</head>
<body>
    <p>Vous consultez le service n°{{ $service['id'] }}.</p>

    @if ($service)
        <ul>
            <li>Nom : {{ $service['nom'] }}</li>
            <li>Responsable : {{ $service['responsable'] }}</li>
            <li>Téléphone : {{ $service['telephone'] }}</li>
        </ul>
    @endif

    <a href="{{ route('services.index') }}">Retour à la liste</a>
</body>
</html>