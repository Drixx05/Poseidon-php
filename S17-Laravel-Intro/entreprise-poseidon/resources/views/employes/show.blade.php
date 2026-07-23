<x-layout>

    <div class="card">
        <div class="card-header">
            <h3>
                {{ $employe->prenom }}
                {{ $employe->nom }}
            </h3>
        </div>
        <div class="card-body">
            <p><strong>Sexe :</strong> {{ $employe->sexe }}</p>
            <p><strong>Service :</strong> {{ $employe->service }}</p>
            <p><strong>Date d'embauche :</strong> {{ $employe->date_embauche }}</p>
            <p><strong>Salaire :</strong>
                {{ number_format($employe->salaire, 2, ',', ' ') }} €
            </p>
        </div>
    </div>

    <a href="{{ route('employes.index') }}" class="btn btn-secondary mt-3">
        Retour
    </a>

</x-layout>
