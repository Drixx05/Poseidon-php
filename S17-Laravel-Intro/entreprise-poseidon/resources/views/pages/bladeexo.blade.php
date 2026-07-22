<x-layout :title='$title'>
    <h1>Exercices blade pour {{ $entreprise }} </h1>

    <h2>Nombre d'employés : {{ count($employes) }} </h2>

    @foreach ($employes as $employe)
        {{ $employe['prenom'] . ' - ' }}
    @endforeach
    <hr>
    @foreach ($employes as $employe)
        {{ $employe['nom'] . ' ' . $employe['prenom'] }}
        <br>
    @endforeach

    <h3>Les employés du service informatique</h3>
    @foreach ($employes as $employe)
        @if ($employe['service'] == 'informatique')
            {{ $employe['nom'] . ' ' . $employe['prenom'] }}
            <br>
        @endif
    @endforeach

    @foreach ($employes as $employe)
        @if ($employe['salaire'] > 2500)
            {{ $employe['nom'] . ' ' . $employe['prenom'] . ' : ' }}
            <span class="text-success"><b> {{ $employe['salaire'] }} </b></span>
            <br>
        @endif
    @endforeach

    @foreach ($employes as $employe)
        @if ($employe['sexe'] == 'm')
            <span class="text-primary">{{ $employe['prenom'] }}</span>
            <br>
        @else
            <span class="text-danger">{{ $employe['prenom'] }}</span>
            <br>
        @endif
    @endforeach

    @foreach ($employes as $employe)
        {{ $employe['nom'] }}
        @switch($employe['service'])
            @case('direction')
                <span class="badge bg-primary">Direction</span>
            @break

            @case('informatique')
                <span class="badge bg-danger">Informatique</span>
            @break

            @case('comptabilite')
                <span class="badge bg-success">Comptabilité</span>
            @break

            @default
                <span class="badge bg-secondary">{{ $employe['service'] }}</span>
        @endswitch
        <br>
    @endforeach

    @forelse ($employes as $employe)
        {{ $employe['nom'] . ' ' . $employe['prenom'] }}
        <br>
    @empty
        <p>Aucun employé</p>
    @endforelse

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Service</th>
                <th>Salaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employes as $employe)
                <tr>
                    <td>{{ $employe['nom'] }}</td>
                    <td>{{ $employe['prenom'] }}</td>
                    <td>{{ $employe['service'] }}</td>
                    <td>{{ number_format($employe['salaire'], 0, ',', ' ') }} €</td>
                    <td>Voir - Modifier - Supprimer</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <br>
    <br>
    <br>
    <br>





</x-layout>
