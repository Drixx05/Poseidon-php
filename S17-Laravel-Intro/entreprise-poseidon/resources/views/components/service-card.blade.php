<div class="card h-100 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title mb-0">{{ $service['nom'] }}</h5>

            {{-- Condition pour choisir la couleur du badge --}}
            @switch($service['nom'])
                @case('Direction')
                    <span class="badge bg-danger">Direction</span>
                @break

                @case('Comptabilité')
                    <span class="badge bg-warning text-dark">Comptabilité</span>
                @break

                @case('Informatique')
                    <span class="badge bg-primary">IT</span>
                @break

                @case('Assistance')
                    <span class="badge bg-success">Support</span>
                @break

                @default
                    <span class="badge bg-secondary">Autre</span>
            @endswitch
        </div>

        <p class="card-text mb-1">
            <strong>Responsable :</strong> {{ $service['responsable'] }}
        </p>
        <p class="card-text text-muted">
            <strong>Tél :</strong> {{ $service['telephone'] }}
        </p>

        <a href="{{ route('services.show', $service['id']) }}" class="btn btn-outline-primary btn-sm">
            Voir le détail
        </a>
    </div>
</div>
