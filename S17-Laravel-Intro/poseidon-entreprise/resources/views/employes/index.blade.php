{{-- @extends('layouts.app')

@section('title')
    Liste des employes
@endsection

@section('content')
<ul>
@forelse($employes as $employe)
<li> {{$employe["nom"]}} - {{$employe["prenom"]}}
<a href="{{route('employes.show', ['id' => $employe['id']])}}">Lien vers l'employe</a>
@empty 
<p>Aucun employe pour l'instant</p>
@endforelse
</ul>
@endsection --}}

<x-layout :title='$title'>
    <x-alert>
        Bienvenue sur la liste des Employés !
    </x-alert>
    @forelse($employes as $employe)
        <x-employe-card :prenom="$employe['prenom']" :nom="$employe['nom']" :service="$employe['service']" :salaire="$employe['salaire']" />
    @empty
        <p>Aucun employe pour l'instant</p>
    @endforelse
</x-layout>
