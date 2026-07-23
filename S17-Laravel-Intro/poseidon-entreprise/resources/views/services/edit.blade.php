<x-layout title="Modifier le service">

    <h1>Modifier le service</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom du service</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $service->nom) }}">
        </div>

        <div class="mb-3">
            <label>Responsable</label>
            <input type="text" name="responsable" class="form-control" value="{{ old('responsable', $service->responsable) }}">
        </div>

        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $service->telephone) }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>

</x-layout>