<?php 

/* 

--- TP Jour 3 - BDD / SQL / Models / Eloquent / Factories / Seeders ---

--- Le module Services
On reste dans le projet Entreprise.
Créer une nouvelle table :
services
Structure :
Champ	    Type
id	        INT
nom	        VARCHAR(50)
responsable	VARCHAR(80)
telephone	VARCHAR(20)

--- Objectifs
Créer entièrement le module Services.
la migration -- Creation de la migration
le modèle    -- Création du modèle
la factory   -- Création de la factory en utilisant faker
le seeder    -- Créer un seeder qui appele la factory et créer une 20aine de services
Le tout en utilisant les conventions Laravel.

--- Les pages à réaliser
/services
Liste de tous les services
/services/{id}
Afficher un seul service
/services/direction
Afficher uniquement le service Direction
/services/responsables
Afficher uniquement :
nom
responsable
/services/count
Afficher le nombre total de services.

--- Réaliser les requêtes suivantes :

1 Afficher tous les employés.
2 Afficher uniquement les prénoms.
3 Afficher uniquement les employés du service comptabilite.
4 Afficher les employés dont le salaire dépasse 2500 €.
5 Afficher les employés recrutés après le 1er janvier 2020.
6 Afficher les employés classés par nom.
7 Afficher les employés classés du salaire le plus élevé au plus faible.
8 Afficher les 5 premiers employés.
9 Afficher les employés dont le prénom commence par A.
10 Afficher le nombre total d'employés.
11 Afficher le salaire moyen.
12 Afficher le salaire moyen par service.
13 Afficher le nombre d'employés par service.
14 Afficher le nombre d'hommes et de femmes.
15 Afficher les services différents.
16 Afficher le dernier employé embauché.
17 Afficher l'employé gagnant le plus gros salaire.
18 Afficher le salarié le moins payé.
19 Afficher les employés du service commercial gagnant plus de 2200 €.
20 Afficher les employés recrutés entre 2020 et 2024.
21 Augmenter tous les salaires de 100 €.
22 Supprimer tous les employés du service Marketing.

*/