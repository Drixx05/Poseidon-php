<x-layout title="Exercices Blade">

    <h1>{{ $entreprise }}</h1>

    <p>Nombre d'employés : {{ count($employes) }}</p>

    <ul>
        @foreach ($employes as $employe)
            <li>{{ $employe['prenom'] }}</li>
        @endforeach
    </ul>

    <ul>
        @foreach ($employes as $employe)
            <li>{{ $employe['nom'] }} - {{ $employe['prenom'] }}</li>
        @endforeach
    </ul>

    <ul>
        @foreach ($employes as $employe)
            @if ($employe['service'] === 'informatique')
                <li>{{ $employe['nom'] }} - {{ $employe['prenom'] }}</li>
            @endif
        @endforeach
    </ul>

    <ul>
        @foreach ($employes as $employe)
            @if ((float) $employe['salaire'] > 2500)
                <li style="color: green;">{{ $employe['nom'] }} - {{ $employe['salaire'] }} €</li>
            @endif
        @endforeach
    </ul>

    <ul>
        @foreach ($employes as $employe)
            <li style="color: {{ $employe['sexe'] === 'm' ? 'blue' : 'pink' }};">
                {{ $employe['nom'] }} - {{ $employe['prenom'] }}
            </li>
        @endforeach
    </ul>

    <ul>
        @foreach ($employes as $employe)
            <li>
                {{ $employe['nom'] }} - {{ $employe['prenom'] }}
                <span class="badge bg-{{ $employe['badge'] }}">
                    {{ $employe['service'] }}
                </span>
            </li>
        @endforeach
    </ul>

    @if (empty($employes))
        <p>Aucun employé</p>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Service</th>
                <th>Salaire</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employes as $employe)
                <tr>
                    <td>{{ $employe['nom'] }}</td>
                    <td>{{ $employe['prenom'] }}</td>
                    <td>{{ $employe['service'] }}</td>
                    <td>{{ $employe['salaire'] }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>