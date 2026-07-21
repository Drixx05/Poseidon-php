{{-- @extends('layouts.app')

@section('title')
    Accueil
@endsection

@section('content')
    <h1 class="mb-4">
        Accueil
    </h1>
    <x-alert>
    Bienvenue sur Entreprise Poseidon !
    </x-alert>
@endsection --}}

<x-layout :title='$title'>
    <h1 class="mb-4">
        Accueil
    </h1>
    <x-alert>
        Bienvenue sur Entreprise Poseidon !
    </x-alert>
</x-layout>
