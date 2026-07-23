<x-layout title="Responsables">

    <h1>Nom et responsable de chaque service</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom du service</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($responsables as $responsable)
                <tr>
                    <td>{{ $responsable->nom }}</td>
                    <td>{{ $responsable->responsable }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-layout>