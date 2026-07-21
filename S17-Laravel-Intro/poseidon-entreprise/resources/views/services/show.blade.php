<x-layout title="Fiche service">


    @if ($service)
            <p>Vous consultez le service n°{{ $service['id'] }}.</p>

            <x-service-card
                :id="$service['id']"
                :nom="$service['nom']"
                :responsable="$service['responsable']"
                :telephone="$service['telephone']"
                :badge="$service['badge']"
            />
        @else
            <p>Service introuvable.</p>
        @endif

    <a href="{{ route('services.index') }}">Retour à la liste</a>

</x-layout>