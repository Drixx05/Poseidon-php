    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                Entreprise
            </a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('home') }}">
                    Accueil
                </a>
                <a class="nav-link" href="{{ route('employes.index') }}">
                    Employés
                </a>
                <a class="nav-link" href="{{ route('services.index') }}">
                    Services
                </a>
                <a class="nav-link" href="{{ route('contact') }}">
                    Contact
                </a>
                <a class="nav-link" href="">
                   Inscription
                </a>
            </div>
        </div>
    </nav>