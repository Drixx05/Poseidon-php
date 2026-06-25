<?php 
namespace MyLibrary; // En rajoutant un namespace cette classe n'est plus simplement la classe utilisateur mais elle est la classe MyLibrary\Utilisateur

class Utilisateur 
{
    public function getNom() 
    {
        return "Bob";
    }
}