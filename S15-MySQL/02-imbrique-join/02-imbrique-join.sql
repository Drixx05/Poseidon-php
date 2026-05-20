
CREATE DATABASE bibliotheque;
USE bibliotheque;

CREATE TABLE abonne (
  id_abonne INT(3) NOT NULL AUTO_INCREMENT,
  prenom VARCHAR(15) NOT NULL,
  PRIMARY KEY (id_abonne)
) ENGINE=InnoDB ;

INSERT INTO abonne (id_abonne, prenom) VALUES
(1, 'Guillaume'),
(2, 'Benoit'),
(3, 'Chloe'),
(4, 'Laura');


CREATE TABLE livre (
  id_livre INT(3) NOT NULL AUTO_INCREMENT,
  auteur VARCHAR(25) NOT NULL,
  titre VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_livre)
) ENGINE=InnoDB ;

INSERT INTO livre (id_livre, auteur, titre) VALUES
(100, 'GUY DE MAUPASSANT', 'Une vie'),
(101, 'GUY DE MAUPASSANT', 'Bel-Ami '),
(102, 'HONORE DE BALZAC', 'Le pere Goriot'),
(103, 'ALPHONSE DAUDET', 'Le Petit chose'),
(104, 'ALEXANDRE DUMAS', 'La Reine Margot'),
(105, 'ALEXANDRE DUMAS', 'Les Trois Mousquetaires');

CREATE TABLE emprunt (
  id_emprunt INT(3) NOT NULL AUTO_INCREMENT,
  id_livre INT(3) DEFAULT NULL,
  id_abonne INT(3) DEFAULT NULL,
  date_sortie DATE NOT NULL,
  date_rendu DATE DEFAULT NULL,
  PRIMARY KEY  (id_emprunt)
) ENGINE=InnoDB ;

INSERT INTO emprunt (id_emprunt, id_livre, id_abonne, date_sortie, date_rendu) VALUES
(1, 100, 1, '2016-12-07', '2016-12-11'),
(2, 101, 2, '2016-12-07', '2016-12-18'),
(3, 100, 3, '2016-12-11', '2016-12-19'),
(4, 103, 4, '2016-12-12', '2016-12-22'),
(5, 104, 1, '2016-12-15', '2016-12-30'),
(6, 105, 2, '2017-01-02', '2017-01-15'),
(7, 105, 3, '2017-02-15', NULL),
(8, 100, 2, '2017-02-20', NULL);

-- Quels sont les id_livre des livres qui n'ont pas été rendu à la bibliotheque ? 
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
-- ATTENTION la valeur NULL se test avec IS NULL ou IS NOT NULL
+----------+
| id_livre |
+----------+
|      105 |
|      100 |
+----------+

-- Pour avoir les titres des livres... Cette information se trouvant sur une autre table...
-- 2 possibilités ! 
-- Requêtes imbriquées (pas le choix préféré)
-- Requêtes en jointure (le choix préféré !)

--------------------------------------------------------------------------
--------------------------------------------------------------------------
---------- REQUETES IMBRIQUEES -------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- Quels sont les titres des livres qui n'ont pas été rendu à la bibliothèque ? 
SELECT titre FROM livre WHERE id_livre IN (100, 105); -- Ici je mets en brut, les id que j'ai trouvé à la requête précédente
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+

-- En fait, une requête imbriquée c'est le fait de pouvoir mettre une requête à l'intérieur d'une autre !
-- On a besoin du résultat de la "sous requete" pour mener à bien la première requête
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL); 
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+
-- Une requête imbriquée m'enverra très régulièrement plusieurs résultats on utilisera toujours IN et non pas = 

-- EXERCICE 1: Quels sont les prénoms des abonnés n'ayant pas rendu un livre à la bibliotheque.
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_rendu IS NULL);
+--------+
| prenom |
+--------+
| Benoit |
| Chloe  |
+--------+
-- EXERCICE 2 : Nous aimerions connaitre le(s) n° des livres empruntés par Chloé
SELECT id_livre FROM emprunt WHERE id_abonne IN ( SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'); 
+----------+
| id_livre |
+----------+
|      100 |
|      105 |
+----------+
-- EXERCICE 3: Affichez les prénoms des abonnés ayant emprunté un livre le 07/12/2016.
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_sortie = "2016-12-07");
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+
-- EXERCICE 4: combien de livre Guillaume a emprunté à la bibliotheque ?
SELECT COUNT(*) AS emprunt_guillaume FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Guillaume");
+-------------------+
| emprunt_guillaume |
+-------------------+
|                 2 |
+-------------------+
-- EXERCICE 5: Affichez la liste des abonnés ayant déjà emprunté un livre d'Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE id_livre IN (SELECT id_livre FROM livre WHERE auteur = "ALPHONSE DAUDET"));
+--------+
| prenom |
+--------+
| Laura  |
+--------+
-- EXERCICE 6: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-------------------------+
| titre                   |
+-------------------------+
| Une vie                 |
| Les Trois Mousquetaires |
+-------------------------+
-- EXERCICE 7: Nous aimerions connaitre les titres des livres que Chloe n'a pas emprunté à la bibliotheque.
SELECT titre FROM livre WHERE id_livre NOT IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Chloe"));
+-----------------+
| titre           |
+-----------------+
| Bel-Ami         |
| Le pere Goriot  |
| Le Petit chose  |
| La Reine Margot |
+-----------------+
-- EXERCICE 8: Nous aimerions connaitre les titres des livres que Chloe a emprunté à la bibliotheque ET qui n'ont pas été rendu.
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = "Chloe") AND date_rendu IS NULL);
+-------------------------+
| titre                   |
+-------------------------+
| Les Trois Mousquetaires |
+-------------------------+

-- EXERCICE 9 :  Qui a emprunté le plus de livre à la bibliotheque ?
SELECT prenom FROM abonne WHERE id_abonne = (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC LIMIT 1);
+--------+
| prenom |
+--------+
| Benoit |
+--------+

-- Le problème de cette requête est qu'elle ne retourne qu'un prénom... Si jamais deux ou plus de personnes ont le même nombre d'emprunt, cette requête n'est pas capable de récupérer tous les prénoms 

SELECT id_abonne, COUNT(*) AS nbr_emprunt FROM emprunt GROUP BY id_abonne ORDER BY COUNT(*) DESC;
-- Ci dessous la liste des abonnés et leur nombre d'emprunts (après avoir rajouté un emprunt à Guillaume (id 1))
+-----------+-------------+
| id_abonne | nbr_emprunt |
+-----------+-------------+
|         1 |           3 |
|         2 |           3 |
|         3 |           2 |
|         4 |           1 |
+-----------+-------------+

-- Sans table temporaire
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
        (SELECT COUNT(*) as nbr_emprunt FROM emprunt GROUP BY id_abonne ORDER BY nbr_emprunt DESC LIMIT 1));
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+

-- Avec table temporaire
SELECT prenom FROM abonne WHERE id_abonne IN 
    (SELECT id_abonne FROM emprunt GROUP BY id_abonne HAVING COUNT(*) = 
        (SELECT MAX(nbr_emprunt) FROM (SELECT COUNT(*) AS nbr_emprunt FROM emprunt GROUP BY id_abonne) AS calcul));
+-----------+
| prenom    |
+-----------+
| Guillaume |
| Benoit    |
+-----------+


--------------------------------------------------------------------------
--------------------------------------------------------------------------
---------- REQUETES EN JOINTURE ------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------

-- Une jointure est toujours possible, même lorsqu'on souhaite afficher des champs de plusieurs tables différentes
-- Une imbriquée ne peut afficher que des informations d'une seule table 

-- Avec une imbriquée on parcourt les tables les unes après les autres en passant par le champ commun PK/FK, mais réellement on utilise rarement les imbriquées dans ces situations
-- On préfèrera les jointures car on peut mélanger les champs de sorties, les appels de tables, les conditions sans que cela pose problème 

-- Nous aimerions connaître les dates de sortie et les dates de rendu pour l'abonné Guillaume 
    -- En imbriquée pas possible ! Les infos des dates de rendu sont sur la table emprunt et l'info "Guillaume" vient de la table abonne 

-- En jointure c'est ok ! 

-- Première syntaxe, pas très conventionnelle mais pratique ! 
SELECT prenom, date_sortie, date_rendu          -- Ce que je veux afficher, de plusieurs tables différentes pas de soucis
FROM emprunt, abonne                            -- Toutes les tables dont j'ai besoin pour cette requête 
WHERE prenom = "Guillaume"                      -- Mes conditions (ici une seule)
AND abonne.id_abonne = emprunt.id_abonne;       -- La jointure ! C'est une condition qui indique quel champ correspond à quel autre sur l'autre table 

-- Lors d'une jointure il est toujours de spécifier les préfixes de tables pour tous les champs appelés
SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu          
FROM emprunt, abonne                            
WHERE abonne.prenom = "Guillaume"                     
AND abonne.id_abonne = emprunt.id_abonne;       

-- Les prefixes pouvant parfois alourdir nos requêtes, on peut donner des alias à nos tables 
SELECT a.prenom, e.date_sortie, e.date_rendu          
FROM emprunt e, abonne a                          -- Ici ma table emprunt s'appelle maintenant e et abonne a 
WHERE a.prenom = "Guillaume"                     
AND a.id_abonne = e.id_abonne;   

-- Autre syntaxe, plus conventionnelle 
-- En utilisant INNER JOIN ou simplement JOIN 
-- Avec cette méthode on joint les tables une par une 
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
INNER JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE a.prenom = "Guillaume";

SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
INNER JOIN abonne a USING (id_abonne) -- On peut utiliser USING si par chance notre PK a exactement le meme nom que la FK (c'est assez rare en général)
WHERE a.prenom = "Guillaume";

-- S'il fallait utiliser une seule syntaxe, on préférera celle ci-dessous, avec JOIN tout court et le ON pour faire la jointure
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM emprunt e 
JOIN abonne a ON e.id_abonne = a.id_abonne 
WHERE a.prenom = "Guillaume";

-- EXERCICE 1 : Nous aimerions connaitre les dates de sortie et les dates de rendu pour les livres écrit par Alphonse Daudet 
SELECT l.titre, e.date_sortie, e.date_rendu  
FROM emprunt e 
JOIN livre l ON e.id_livre = l.id_livre 
WHERE l.auteur = "ALPHONSE DAUDET";
+----------------+-------------+------------+
| titre          | date_sortie | date_rendu |
+----------------+-------------+------------+
| Le Petit chose | 2016-12-12  | 2016-12-22 |
+----------------+-------------+------------+
-- EXERCICE 2 : Qui a emprunté le livre "une vie" sur l'année 2016 
SELECT a.prenom, l.titre, e.date_sortie 
FROM abonne a 
JOIN emprunt e ON e.id_abonne = a.id_abonne 
JOIN livre l ON e.id_livre = l.id_livre 
WHERE date_sortie LIKE "2016%"
AND l.titre = "Une vie";
+-----------+---------+-------------+
| prenom    | titre   | date_sortie |
+-----------+---------+-------------+
| Guillaume | Une vie | 2016-12-07  |
| Chloe     | Une vie | 2016-12-11  |
+-----------+---------+-------------+
-- EXERCICE 3 : Nous aimerions connaitre le nombre de livre emprunté par chaque abonné 
SELECT a.prenom, COUNT(*) as nbr_emprunts
FROM abonne a 
JOIN emprunt e ON a.id_abonne = e.id_abonne 
GROUP BY a.id_abonne;
+-----------+--------------+
| prenom    | nbr_emprunts |
+-----------+--------------+
| Guillaume |            3 |
| Benoit    |            3 |
| Chloe     |            2 |
| Laura     |            1 |
+-----------+--------------+
-- EXERCICE 4 : Nous aimerions connaitre le nombre de livre emprunté à rendre par chaque abonné 
SELECT a.prenom, COUNT(*) as a_rendre 
FROM abonne a 
JOIN emprunt e ON a.id_abonne = e.id_abonne 
WHERE e.date_rendu IS NULL
GROUP BY a.id_abonne;
+-----------+----------+
| prenom    | a_rendre |
+-----------+----------+
| Chloe     |        1 |
| Benoit    |        1 |
| Guillaume |        1 |
+-----------+----------+
-- EXERCICE 5 : Qui (prenom) a emprunté Quoi (titre) et Quand (date_sortie) ?
SELECT a.prenom, l.titre, e.date_sortie 
FROM emprunt e 
JOIN abonne a ON a.id_abonne = e.id_abonne 
JOIN livre l ON l.id_livre = e.id_livre
ORDER BY a.prenom;


--------------------------------------------------------------------------
--------------------------------------------------------------------------
---------- JOINTURE EXTERNE ----------------------------------------------
--------------------------------------------------------------------------
--------------------------------------------------------------------------

-- Enregistrez vous dans la table abonné 
INSERT INTO abonne (prenom) VALUES ("Pierra");
SELECT * FROM abonne;
+-----------+-----------+
| id_abonne | prenom    |
+-----------+-----------+
|         1 | Guillaume |
|         2 | Benoit    |
|         3 | Chloe     |
|         4 | Laura     |
|         5 | Pierra    |
+-----------+-----------+

-- Affichez tous les prénoms des abonnés SANS EXCEPTION ainsi que les id_livre qu'ils ont empruntés si c'est le cas 
SELECT a.prenom, e.id_livre 
FROM abonne a 
JOIN emprunt e ON e.id_abonne = a.id_abonne
ORDER BY a.prenom;
+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Benoit    |      101 |
| Benoit    |      105 |
| Benoit    |      100 |
| Chloe     |      100 |
| Chloe     |      105 |
| Guillaume |      100 |
| Guillaume |      104 |
| Guillaume |      100 |
| Laura     |      103 |
+-----------+----------+
-- Avec ces requêtes (un JOIN classique, donc jointure interne), le nouvel abonné sans emprunt n'apparait pas dans le resultat ! 
-- C'est normal, nous n'avons pas de correspondance dans la table emprunt, la jointure interne se limite aux éléments ayant des correspondances des deux côtés 
-- Pour récupérer l'intégralité d'une table et obtenir toutes les informations meme sans correspondance on utiliser une jointure EXTERNE ! 
-- Attention lors d'une jointure externe l'ordre des tables dans la requête est important ! 


-- Jointure externe : LEFT JOIN ou RIGHT JOIN 
-- LEFT OU RIGHT : même fonctionnalité SAUF que l'on change le sens de la priorité/jointure 
SELECT a.prenom, e.id_livre 
FROM abonne a 
LEFT JOIN emprunt e ON e.id_abonne = a.id_abonne -- Ici avec un LEFT JOIN, je priorise la table la plus à gauche de la requête 
ORDER BY a.prenom;

SELECT a.prenom, e.id_livre 
FROM emprunt e RIGHT JOIN abonne a ON e.id_abonne = a.id_abonne -- Ici avec un RIGHT JOIN, je priorise la table la plus à gauche de la requête 
ORDER BY a.prenom;
+-----------+----------+
| prenom    | id_livre |
+-----------+----------+
| Benoit    |      100 |
| Benoit    |      105 |
| Benoit    |      101 |
| Chloe     |      105 |
| Chloe     |      100 |
| Guillaume |      100 |
| Guillaume |      104 |
| Guillaume |      100 |
| Laura     |      103 |
| Pierra    |     NULL |
+-----------+----------+
-- Grace à ces LEFT ou RIGHT JOIN je récupère bien Pierra ! L'abonné sans emprunt ! :)


-- EXERCICE 1 : Affichez tous les livres sans exception puis les id_abonne ayant emprunté ces livres si c'est le cas
SELECT l.titre, e.id_abonne FROM livre l LEFT JOIN emprunt e ON e.id_livre = l.id_livre;
+-------------------------+-----------+
| titre                   | id_abonne |
+-------------------------+-----------+
| Une vie                 |         1 |
| Une vie                 |         2 |
| Une vie                 |         3 |
| Une vie                 |         1 |
| Bel-Ami                 |         2 |
| Le pere Goriot          |      NULL |
| Le Petit chose          |         4 |
| La Reine Margot         |         1 |
| Les Trois Mousquetaires |         3 |
| Les Trois Mousquetaires |         2 |
+-------------------------+-----------+
-- EXERCICE 2 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre
SELECT a.prenom, e.id_livre, l.auteur, l.titre FROM abonne a LEFT JOIN emprunt e ON a.id_abonne = e.id_abonne LEFT JOIN livre l ON e.id_livre = l.id_livre;
+-----------+----------+-------------------+-------------------------+
| prenom    | id_livre | auteur            | titre                   |
+-----------+----------+-------------------+-------------------------+
| Guillaume |      100 | GUY DE MAUPASSANT | Une vie                 |
| Guillaume |      104 | ALEXANDRE DUMAS   | La Reine Margot         |
| Guillaume |      100 | GUY DE MAUPASSANT | Une vie                 |
| Benoit    |      100 | GUY DE MAUPASSANT | Une vie                 |
| Benoit    |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Benoit    |      101 | GUY DE MAUPASSANT | Bel-Ami                 |
| Chloe     |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Chloe     |      100 | GUY DE MAUPASSANT | Une vie                 |
| Laura     |      103 | ALPHONSE DAUDET   | Le Petit chose          |
| Pierra    |     NULL | NULL              | NULL                    |
+-----------+----------+-------------------+-------------------------+
-- EXERCICE 3 : Affichez tous les prénoms des abonnés et s'ils ont fait des emprunts, affichez les id_livre, auteur et titre ainsi que les livres non empruntés :)
SELECT a.prenom, e.id_livre, l.auteur, l.titre 
FROM abonne a 
LEFT JOIN emprunt e ON a.id_abonne = e.id_abonne 
LEFT JOIN livre l ON e.id_livre = l.id_livre 
UNION
SELECT NULL as prenom, l.id_livre, l.auteur, l.titre 
FROM livre l 
LEFT JOIN emprunt e ON l.id_livre = e.id_livre 
WHERE e.id_livre IS NULL;


SELECT a.prenom, e.id_livre, l.auteur, l.titre 
FROM abonne a 
LEFT JOIN emprunt e ON a.id_abonne = e.id_abonne 
LEFT JOIN livre l ON e.id_livre = l.id_livre 
UNION
SELECT a.prenom, e.id_livre, l.auteur, l.titre 
FROM abonne a 
RIGHT JOIN emprunt e ON a.id_abonne = e.id_abonne 
RIGHT JOIN livre l ON e.id_livre = l.id_livre;

+-----------+----------+-------------------+-------------------------+
| prenom    | id_livre | auteur            | titre                   |
+-----------+----------+-------------------+-------------------------+
| Guillaume |      100 | GUY DE MAUPASSANT | Une vie                 |
| Guillaume |      104 | ALEXANDRE DUMAS   | La Reine Margot         |
| Benoit    |      100 | GUY DE MAUPASSANT | Une vie                 |
| Benoit    |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Benoit    |      101 | GUY DE MAUPASSANT | Bel-Ami                 |
| Chloe     |      105 | ALEXANDRE DUMAS   | Les Trois Mousquetaires |
| Chloe     |      100 | GUY DE MAUPASSANT | Une vie                 |
| Laura     |      103 | ALPHONSE DAUDET   | Le Petit chose          |
| Pierra    |     NULL | NULL              | NULL                    |
| NULL      |     NULL | HONORE DE BALZAC  | Le pere Goriot          |
+-----------+----------+-------------------+-------------------------+