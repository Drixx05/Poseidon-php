<x-layout>

    <h1 class="mb-4">

        Ajouter un employé

    </h1>

    <form action="{{ route('employes.update', $employe->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">
                Prénom
            </label>
            <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $employe->prenom ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">
                Nom
            </label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $employe->nom ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">
                Sexe
            </label>
            <select name="sexe" class="form-select">
                <option value="m" @selected(old('sexe', $employe->sexe ?? '') == 'm')>
                    Homme
                </option>
                <option value="f" @selected(old('sexe', $employe->sexe ?? '') == 'f')>
                    Femme
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">
                Service
            </label>
            <input type="text" name="service" class="form-control"
                value="{{ old('service', $employe->service ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">
                Date d'embauche
            </label>
            <input type="date" name="date_embauche" class="form-control"
                value="{{ old('date_embauche', $employe->date_embauche ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">
                Salaire
            </label>
            <input type="number" step="0.01" name="salaire" class="form-control"
                value="{{ old('salaire', $employe->salaire ?? '') }}">
        </div>

        <button class="btn btn-success">
            Enregistrer
        </button>

    </form>

    <br><br><br><br>

</x-layout>
