<x-layout title="Nouveau service">

    <h1>Créer un service</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nom du service</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
        </div>

        <div class="mb-3">
            <label>Responsable</label>
            <input type="text" name="responsable" class="form-control" value="{{ old('responsable') }}">
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
    </form>

</x-layout>