<x-layout title="Liste des services">

    <h1>Liste des services</h1>

    <p>Nombre total de services : {{ count($services) }}</p>

    @forelse ($services as $service)
        <x-service-card
            :id="$service['id']"
            :nom="$service['nom']"
            :responsable="$service['responsable']"
            :telephone="$service['telephone']"
            :badge="$service['badge']"
        />
    @empty
        <p>Aucun service</p>
    @endforelse

    <p class="text-muted mt-4">Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</p>

</x-layout>