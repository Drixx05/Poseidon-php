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
    {{-- <x-alert>
        Bienvenue sur la liste des Employés !
    </x-alert>
    @forelse($employes as $employe)
        <x-employe-card :prenom="$employe->prenom" :nom="$employe->nom" :service="$employe->service" :salaire="$employe->salaire" />
    @empty
        <p>Aucun employe pour l'instant</p>
    @endforelse --}}

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des employés</h1>
        <a href="{{ route('employes.create') }}" class="btn btn-success">
            Ajouter un employé
        </a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Service</th>
                <th>Salaire</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($employes as $employe)
                <tr>
                    <td>{{ $employe->id }}</td>
                    <td>{{ $employe->prenom }}</td>
                    <td>{{ $employe->nom }}</td>
                    <td>{{ $employe->service }}</td>
                    <td>{{ number_format($employe->salaire, 2, ',', ' ') }} €</td>
                    <td class="text-end">
                        <a href="{{ route('employes.show', $employe) }}" class="btn btn-primary btn-sm">
                            Voir
                        </a>
                        <a href="{{ route('employes.edit', $employe) }}" class="btn btn-warning btn-sm">
                            Modifier
                        </a>
                        <form action="{{ route('employes.destroy', $employe) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet employé ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>
