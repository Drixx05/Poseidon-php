{{-- @extends('layouts.app')

@section('title')
    Liste des services
@endsection

@section('content')
    <ul> --}}
        <?php 
// // var_dump($services)
// foreach($services as $service){
//     echo "<li>";
//     echo $service["nom"] . " - Responsable : " . $service["responsable"];
// 
//         <a href="{{ route('services.show', ['id' => $service['id']]) }}">Lien vers le service</a>
//         <?php
//     echo "</li>";
// }
?>
    {{-- </ul> --}}
<x-layout>
    <ul>
        @forelse($services as $service)

        <x-service-card :service="$service" />
            {{-- <li> {{ $service['nom'] }} - Responsable : {{ $service['responsable'] }}
                <a href="{{ route('services.show', ['id' => $service['id']]) }}">Lien vers le service</a> --}}
            @empty
                <p>Aucun service pour l'instant</p>
        @endforelse
    </ul>
</x-layout>




{{-- @endsection --}}
