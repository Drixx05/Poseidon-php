<x-layout title="Requêtes Employés">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Requêtes sur les employés</h1>

    <h3>1. Tous les employés ({{ $tousLesEmployes->count() }})</h3>
    <ul>
        @foreach ($tousLesEmployes as $e)
            <li>{{ $e->nom }} {{ $e->prenom }}</li>
        @endforeach
    </ul>

    <h3>2. Tous les prénoms</h3>
    <p>{{ $prenoms->implode(', ') }}</p>

    <h3>3. Employés du service Comptabilité</h3>
    <ul>
        @foreach ($employesComptabilite as $e)
            <li>{{ $e->nom }} {{ $e->prenom }}</li>
        @endforeach
    </ul>

    <h3>4. Salaire &gt; 2500 €</h3>
    <ul>
        @foreach ($salairesSuperieurs2500 as $e)
            <li>{{ $e->nom }} - {{ $e->salaire }} €</li>
        @endforeach
    </ul>

    <h3>5. Recrutés après le 01/01/2020</h3>
    <ul>
        @forelse ($recrutesApres2020 as $e)
            <li>{{ $e->nom }} - {{ $e->date_embauche->format('d/m/Y') }}</li>
        @empty
            <li>Aucun</li>
        @endforelse
    </ul>

    <h3>6. Triés par nom</h3>
    <ul>
        @foreach ($triesParNom as $e)
            <li>{{ $e->nom }}</li>
        @endforeach
    </ul>

    <h3>7. Triés par salaire décroissant</h3>
    <ul>
        @foreach ($triesParSalaireDesc as $e)
            <li>{{ $e->nom }} - {{ $e->salaire }} €</li>
        @endforeach
    </ul>

    <h3>8. Les 5 premiers</h3>
    <ul>
        @foreach ($cinqPremiers as $e)
            <li>{{ $e->nom }}</li>
        @endforeach
    </ul>

    <h3>9. Prénom commence par A</h3>
    <ul>
        @forelse ($prenomCommenceParA as $e)
            <li>{{ $e->prenom }}</li>
        @empty
            <li>Aucun</li>
        @endforelse
    </ul>

    <h3>10. Nombre total d'employés</h3>
    <p>{{ $nombreTotalEmployes }}</p>

    <h3>11. Salaire moyen</h3>
    <p>{{ round($salaireMoyen, 2) }} €</p>

    <h3>12. Salaire moyen par service</h3>
    <ul>
        @foreach ($salaireMoyenParService as $s)
            <li>{{ $s->service }} : {{ round($s->moyenne, 2) }} €</li>
        @endforeach
    </ul>

    <h3>13. Nombre d'employés par service</h3>
    <ul>
        @foreach ($nombreParService as $s)
            <li>{{ $s->service }} : {{ $s->total }}</li>
        @endforeach
    </ul>

    <h3>14. Nombre d'hommes et de femmes</h3>
    <ul>
        @foreach ($nombreHommesFemmes as $s)
            <li>{{ $s->sexe }} : {{ $s->total }}</li>
        @endforeach
    </ul>

    <h3>15. Services différents</h3>
    <ul>
        @foreach ($servicesDifferents as $s)
            <li>{{ $s->service }}</li>
        @endforeach
    </ul>

    <h3>16. Dernier employé embauché</h3>
    <p>{{ $dernierEmbauche->nom }} - {{ $dernierEmbauche->date_embauche->format('d/m/Y') }}</p>

    <h3>17. Salaire le plus élevé</h3>
    <p>{{ $salaireLePlusEleve->nom }} - {{ $salaireLePlusEleve->salaire }} €</p>

    <h3>18. Salaire le plus faible</h3>
    <p>{{ $salaireLePlusFaible->nom }} - {{ $salaireLePlusFaible->salaire }} €</p>

    <h3>19. Commercial &gt; 2200 €</h3>
    <ul>
        @forelse ($commercialPlus2200 as $e)
            <li>{{ $e->nom }} - {{ $e->salaire }} €</li>
        @empty
            <li>Aucun</li>
        @endforelse
    </ul>

    <h3>20. Recrutés entre 2020 et 2024</h3>
    <ul>
        @forelse ($recrutesEntre2020et2024 as $e)
            <li>{{ $e->nom }} - {{ $e->date_embauche->format('d/m/Y') }}</li>
        @empty
            <li>Aucun</li>
        @endforelse
    </ul>

    <hr>

    <h3>21. Augmenter tous les salaires de 100 €</h3>
    <form action="{{ route('requetes.augmenter-salaires') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-warning">Augmenter les salaires</button>
    </form>

    <h3>22. Supprimer les employés du service Marketing</h3>
    <form action="{{ route('requetes.supprimer-marketing') }}" method="POST" class="mt-2">
        @csrf
        <button type="submit" class="btn btn-danger">Supprimer Marketing</button>
    </form>

</x-layout>