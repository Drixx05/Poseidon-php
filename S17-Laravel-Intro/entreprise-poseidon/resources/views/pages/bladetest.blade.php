 {{ $titre }}
 {!! $titre !!}

 <h2> {{ $entreprise . ' ' . $employe }} </h2>
 {{-- Commentaire blade non visible dans le code source sur le navigateur, c'est comme un commentaire php --}}
 <!-- Commentaire HTML visible dans le code source -->

 {{-- Les directives blades --}}
 @if ($admin)
     <p>Admin ok!</p>
 @endif

 @if ($admin)
     <p>Admin ok!</p>
 @else
     <p>Membre normal!</p>
 @endif


@if($age >= 18)
<p>Vous êtes majeur</p>
@elseif ($age >= 16)
<p>Bientot majeur</p>
@else 
<p>Encore trop petit !</p>
@endif

@unless($admin)
<p>Pas admin</p>
@endunless

@foreach($employes as $employe)
<p> {{$employe['prenom']}} </p>
@endforeach

{{-- forelse, comme un foreach mais gère la condition si le array est empty --}}
@forelse ($employes as $employe)
<p> {{$employe['prenom']}} </p>
@empty
<p>Aucun employé</p>
@endforelse

@for($i = 0; $i < 5; $i++)
<p>Le compteur est à : {{$i}} </p>
@endfor 

@while($tentatives > 0)
    <p>Il vous reste {{$tentatives}} tentatives</p>
    <?php $tentatives--; ?>
@endwhile

{{-- Helpers --}}
{{route("employes.index")}}
{{date("d/m/Y")}}
{{strtoupper($titre)}}

@php
echo "<p>Coucou je suis dans du php ouvert par blade</p>";
@endphp