<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des services</title>
</head>
<body>
    @include('layout.nav')
    <h1>Liste des services</h1>

    <ul>
        @foreach ($services as $service)
            <li>
                <a href="{{ route('services.show', $service['id']) }}">
                    {{ $service['nom'] }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>