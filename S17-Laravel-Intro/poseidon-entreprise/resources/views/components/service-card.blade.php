<div class="card shadow-sm mb-3">
    <div class="card-body">
        <h5>
            {{ $nom }}
            <span class="badge bg-{{ $badge }}">{{ $nom }}</span>
        </h5>
        <p>Responsable : {{ $responsable }}</p>
        <p>Téléphone : {{ $telephone }}</p>
        <a href="{{ route('services.show', $id) }}">Voir la fiche</a>
    </div>
</div>