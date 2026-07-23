<x-layout title="Liste des services">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h1>Liste des services</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">+ Nouveau service</a>

    <p>Nombre total de services : {{ count($services) }}</p>

    @forelse ($services as $service)
        <x-service-card
            :id="$service->id"
            :nom="$service->nom"
            :responsable="$service->responsable"
            :telephone="$service->telephone"
            :badge="$service->badge"
        />
        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-secondary">Modifier</a>
        <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
        </form>
    @empty
        <p>Aucun service</p>
    @endforelse
    
    <p class="text-muted mt-4">Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</p>

</x-layout>