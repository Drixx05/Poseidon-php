<x-layout title="Service Direction">

    <h1>Service Direction</h1>

    @forelse ($services as $service)
        <x-service-card
            :id="$service->id"
            :nom="$service->nom"
            :responsable="$service->responsable"
            :telephone="$service->telephone"
            :badge="$service->badge"
        />
    @empty
        <p>Aucun service Direction trouvé.</p>
    @endforelse

</x-layout>