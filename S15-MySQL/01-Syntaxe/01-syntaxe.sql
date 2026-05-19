-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
----------------------- SYNTAXE MYSQL -----------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------


-- Ceci est un commentaire jusqu'à la fin de la ligne
# Ceci est un commentaire aussi jusquà la fin de la ligne (dans les exports phpmyadmin)
/* 

Entre les deux indicateurs 
*/

-- Lien utile, la documentation SQL : https://sql.sh/  

-- Les requêtes ne sont pas sensibles à la casse, cependant, une convention d'écriture veut que nous écrivions les mots clés en majuscule 
-- SELECT prenom FROM listeAbonnes; 

-- Chaque instruction doit se terminer par un ; 

-- Pour se connecter à la console MySQL : 

    -- Wamp : Ouvrir le menu MySQL et console MySQL
    -- Xampp : Ouvrir le shell et taper : mysql -u root -p
    -- Mamp : /Applications/MAMP/Library/bin/mysql -u root -p  (attention sur mac le password est aussi root)

-- Pour créer une BASE 
CREATE DATABASE une_bdd;
CREATE DATABASE entreprise; -- Cette instruction nous permet de créer une BDD 

SHOW DATABASES; -- Pour voir la liste des BDD sur le serveur 
SHOW TABLES; -- Pour voir la liste des tables d'une BDD
SHOW WARNINGS; -- Les warnings de la dernière requête exécutée

USE une_bdd; -- Pour se positionner avec la console sur une BDD pour intéragir dessus
SELECT DATABASE(); -- Pour vérifier quelle est la base sur laquelle on se trouve 
USE entreprise;

DROP DATABASE une_bdd; -- Pour supprimer une BDD 
DROP TABLE nom_de_la_table; -- Pour supprimer une table 

TRUNCATE nom_de_table; -- Pour vider la table (attention, c'est une requête de structure)
DELETE FROM nom_de_table; -- Pour vider la table (requête crud classique)

DESC nom_de_table; -- Pour avoir un

CREATE DATABASE entreprise; 
USE entreprise;

-- Création d'une table employes dans la base entreprise
CREATE TABLE IF NOT EXISTS employes (
  id_employes int(3) NOT NULL AUTO_INCREMENT,
  prenom varchar(20) DEFAULT NULL,
  nom varchar(20) DEFAULT NULL,
  sexe enum('m','f') NOT NULL,
  service varchar(30) DEFAULT NULL,
  date_embauche date DEFAULT NULL,
  salaire float DEFAULT NULL,
  PRIMARY KEY (id_employes)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

-- Insertions dans la table employes 
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES
(350, 'Jean-pierre', 'Laborde', 'm', 'direction', '2010-12-09', 5000),
(388, 'Clement', 'Gallet', 'm', 'commercial', '2010-12-15', 2300),
(415, 'Thomas', 'Winter', 'm', 'commercial', '2011-05-03', 3550),
(417, 'Chloe', 'Dubar', 'f', 'production', '2011-09-05', 1900),
(491, 'Elodie', 'Fellier', 'f', 'secretariat', '2011-11-22', 1600),
(509, 'Fabrice', 'Grand', 'm', 'comptabilite', '2011-12-30', 2900),
(547, 'Melanie', 'Collier', 'f', 'commercial', '2012-01-08', 3100),
(592, 'Laura', 'Blanchet', 'f', 'direction', '2012-05-09', 4500),
(627, 'Guillaume', 'Miller', 'm', 'commercial', '2012-07-02', 1900),
(655, 'Celine', 'Perrin', 'f', 'commercial', '2012-09-10', 2700),
(699, 'Julien', 'Cottet', 'm', 'secretariat', '2013-01-05', 1390),
(701, 'Mathieu', 'Vignal', 'm', 'informatique', '2013-04-03', 2500),
(739, 'Thierry', 'Desprez', 'm', 'secretariat', '2013-07-17', 1500),
(780, 'Amandine', 'Thoyer', 'f', 'communication', '2014-01-23', 2100),
(802, 'Damien', 'Durand', 'm', 'informatique', '2014-07-05', 2250),
(854, 'Daniel', 'Chevel', 'm', 'informatique', '2015-09-28', 3100),
(876, 'Nathalie', 'Martin', 'f', 'juridique', '2016-01-12', 3550),
(900, 'Benoit', 'Lagarde', 'm', 'production', '2016-06-03', 2550),
(933, 'Emilie', 'Sennard', 'f', 'commercial', '2017-01-11', 1800),
(990, 'Stephanie', 'Lafaye', 'f', 'assistant', '2017-03-01', 1775);


------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- REQUETES DE SELECTION -----------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Affichage complet des données d'une table 
SELECT * FROM employes;

-- Affichage d'uniquement certains champs 
SELECT nom, prenom, service FROM employes;

-- Exercice : Affichez la liste des différents services de la table employes 
SELECT service FROM employes;
-- Pour éviter les doublons et avoir une liste des différents services je rajoute DISTINCT
SELECT DISTINCT service FROM employes;
+---------------+
| service       |
+---------------+
| direction     |
| commercial    |
| production    |
| secretariat   |
| comptabilite  |
| informatique  |
| communication |
| juridique     |
| assistant     |
+---------------+

-- CONDITION WHERE
-- Affichage des employes du service informatique 
SELECT * FROM employes WHERE service = "informatique";
+-------------+---------+--------+------+--------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service      | date_embauche | salaire |
+-------------+---------+--------+------+--------------+---------------+---------+
|         701 | Mathieu | Vignal | m    | informatique | 2013-04-03    |    2500 |
|         802 | Damien  | Durand | m    | informatique | 2014-07-05    |    2250 |
|         854 | Daniel  | Chevel | m    | informatique | 2015-09-28    |    3100 |
+-------------+---------+--------+------+--------------+---------------+---------+

-- BETWEEN
-- Affichage des employés ayant été embauché entre 2015 et aujourd'hui
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND "2026-05-18";
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND NOW(); -- Fonction NOW() retourne la date et l'heure de maintenant
SELECT * FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND CURDATE(); -- CURDATE() retour la date d'aujourd'hui
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         854 | Daniel    | Chevel  | m    | informatique | 2015-09-28    |    3100 |
|         876 | Nathalie  | Martin  | f    | juridique    | 2016-01-12    |    3550 |
|         900 | Benoit    | Lagarde | m    | production   | 2016-06-03    |    2550 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
|         990 | Stephanie | Lafaye  | f    | assistant    | 2017-03-01    |    1775 |
+-------------+-----------+---------+------+--------------+---------------+---------+

-- LIKE la valeur approchante 
-- Like nous permet de lancer des recherches sur une information pas saisie complètement 
-- Affichage des prénoms commençant par la lettre "s" 

-- % signifiant peu importe ce qui est ici
SELECT prenom FROM employes WHERE prenom LIKE "s%";
+-----------+
| prenom    |
+-----------+
| Stephanie |
+-----------+

-- Affichage des prénoms finissant par "ie"
SELECT prenom FROM employes WHERE prenom LIKE "%ie";
+-----------+
| prenom    |
+-----------+
| Elodie    |
| Melanie   |
| Nathalie  |
| Emilie    |
| Stephanie |
+-----------+

-- Affichage des prénoms contenant "ie"
SELECT prenom FROM employes WHERE prenom LIKE "%ie%";
+-------------+
| prenom      |
+-------------+
| Jean-pierre |
| Elodie      |
| Melanie     |
| Julien      |
| Mathieu     |
| Thierry     |
| Damien      |
| Daniel      |
| Nathalie    |
| Emilie      |
| Stephanie   |
+-------------+


-- EXCLUSION 
-- Tous les employés sauf ceux d'un service particulier, par exemple sauf commercial
SELECT * FROM employes WHERE service != "commercial"; -- différent de commercial
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

-- Les opérateurs de comparaison : 
-- =   est égal à 
-- !=  est différent de 
-- <   strictement inférieur
-- <=  inférieur ou égal
-- >   supérieur
-- >=  supérieur ou égal 

-- Les employés ayant un salaire supérieur à 3000
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;
+----------+-------------+--------------+---------+
| nom      | prenom      | service      | salaire |
+----------+-------------+--------------+---------+
| Laborde  | Jean-pierre | direction    |    5000 |
| Winter   | Thomas      | commercial   |    3550 |
| Collier  | Melanie     | commercial   |    3100 |
| Blanchet | Laura       | direction    |    4500 |
| Chevel   | Daniel      | informatique |    3100 |
| Martin   | Nathalie    | juridique    |    3550 |
+----------+-------------+--------------+---------+

-- ORDER BY pour ordonner les résultats 
-- Affichage des employes dans l'ordre alphabétique 
SELECT * FROM employes ORDER BY nom;
SELECT * FROM employes ORDER BY nom ASC; -- ASC pour ascendant (cas par défaut)
SELECT * FROM employes ORDER BY nom DESC; -- DESC pour descendant (alphabétique inversé)

-- Il est possible d'ordonner par plusieurs champs. Si le premier forme "un bloc" / a des valeurs similaires, on peut classer par un autre champ ensuite
-- Classer par service puis par nom 
SELECT service, nom, prenom FROM employes ORDER BY service, nom;
+---------------+----------+-------------+
| service       | nom      | prenom      |
+---------------+----------+-------------+
| assistant     | Lafaye   | Stephanie   |
| commercial    | Collier  | Melanie     |
| commercial    | Gallet   | Clement     |
| commercial    | Miller   | Guillaume   |
| commercial    | Perrin   | Celine      |
| commercial    | Sennard  | Emilie      |
| commercial    | Winter   | Thomas      |
| communication | Thoyer   | Amandine    |
| comptabilite  | Grand    | Fabrice     |
| direction     | Blanchet | Laura       |
| direction     | Laborde  | Jean-pierre |
| informatique  | Chevel   | Daniel      |
| informatique  | Durand   | Damien      |
| informatique  | Vignal   | Mathieu     |
| juridique     | Martin   | Nathalie    |
| production    | Dubar    | Chloe       |
| production    | Lagarde  | Benoit      |
| secretariat   | Cottet   | Julien      |
| secretariat   | Desprez  | Thierry     |
| secretariat   | Fellier  | Elodie      |
+---------------+----------+-------------+

-- LIMIT pour limiter le nombre de résultat 
-- Affichage des employés 3 par 3  
SELECT * FROM employes LIMIT 0, 3; -- LIMIT position_de_depart, nb_de_ligne
+-------------+-------------+---------+------+------------+---------------+---------+
| id_employes | prenom      | nom     | sexe | service    | date_embauche | salaire |
+-------------+-------------+---------+------+------------+---------------+---------+
|         350 | Jean-pierre | Laborde | m    | direction  | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet  | m    | commercial | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter  | m    | commercial | 2011-05-03    |    3550 |
+-------------+-------------+---------+------+------------+---------------+---------+
SELECT * FROM employes LIMIT 3, 3;
+-------------+---------+---------+------+--------------+---------------+---------+
| id_employes | prenom  | nom     | sexe | service      | date_embauche | salaire |
+-------------+---------+---------+------+--------------+---------------+---------+
|         417 | Chloe   | Dubar   | f    | production   | 2011-09-05    |    1900 |
|         491 | Elodie  | Fellier | f    | secretariat  | 2011-11-22    |    1600 |
|         509 | Fabrice | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
+-------------+---------+---------+------+--------------+---------------+---------+
SELECT * FROM employes LIMIT 6, 3;
+-------------+-----------+----------+------+------------+---------------+---------+
| id_employes | prenom    | nom      | sexe | service    | date_embauche | salaire |
+-------------+-----------+----------+------+------------+---------------+---------+
|         547 | Melanie   | Collier  | f    | commercial | 2012-01-08    |    3100 |
|         592 | Laura     | Blanchet | f    | direction  | 2012-05-09    |    4500 |
|         627 | Guillaume | Miller   | m    | commercial | 2012-07-02    |    1900 |
+-------------+-----------+----------+------+------------+---------------+---------+

-- On peut utiliser un seul param à LIMIT, ce sera le nombre de lignes sorties 
-- Par exemple les 10 premieres lignes d'une requête 
SELECT * FROM employes LIMIT 10;

-- La syntaxe ci dessous est celle de PostgreSQL, mais elle fonctionne aussi en MySQL ! 
SELECT * FROM employes LIMIT 10 OFFSET 0;


-- On peut faire des opérations dans les champs que l'on souhaite sélectionner
-- Par exemple : 
-- Affichage des employes avec leur salaire annuel
SELECT nom, prenom, service, salaire * 12 FROM employes;
SELECT nom, prenom, service, salaire * 12 AS "salaire_annuel" FROM employes;
+----------+-------------+---------------+--------------+
| nom      | prenom      | service       | salaire * 12 |
+----------+-------------+---------------+--------------+
| Laborde  | Jean-pierre | direction     |        60000 |
| Gallet   | Clement     | commercial    |        27600 |
| Winter   | Thomas      | commercial    |        42600 |
| Dubar    | Chloe       | production    |        22800 |
| Fellier  | Elodie      | secretariat   |        19200 |
| Grand    | Fabrice     | comptabilite  |        34800 |
| Collier  | Melanie     | commercial    |        37200 |
| Blanchet | Laura       | direction     |        54000 |
| Miller   | Guillaume   | commercial    |        22800 |
| Perrin   | Celine      | commercial    |        32400 |
| Cottet   | Julien      | secretariat   |        16680 |
| Vignal   | Mathieu     | informatique  |        30000 |
| Desprez  | Thierry     | secretariat   |        18000 |
| Thoyer   | Amandine    | communication |        25200 |
| Durand   | Damien      | informatique  |        27000 |
| Chevel   | Daniel      | informatique  |        37200 |
| Martin   | Nathalie    | juridique     |        42600 |
| Lagarde  | Benoit      | production    |        30600 |
| Sennard  | Emilie      | commercial    |        21600 |
| Lafaye   | Stephanie   | assistant     |        21300 |
+----------+-------------+---------------+--------------+

-- AS nous permet de donner un surnom à la colonne lors de la récupération. Il faut déjà penser à la récupération des informations avec notre langage back, un indice "salaire * 12" serait problématique, on renomme donc en snake case, c'est la convention d'écriture des noms de champs en mysql 


----------- Fonctions d'agrégation --------------------------------------

-- SUM() pour avoir la somme 
-- La masse salariale annuelle de l'entreprise
SELECT SUM(salaire * 12) AS "masse_salariale" FROM employes;
+-----------------+
| masse_salariale |
+-----------------+
|          623580 |
+-----------------+

-- AVG() la moyenne 
-- Affichage du salaire moyen de l'entreprise
SELECT AVG(salaire) AS "salaire_moyen" FROM employes;
+---------------+
| salaire_moyen |
+---------------+
|       2598.25 |
+---------------+

-- ROUND() pour arrondir 
-- ROUND(valeur) => à l'entier
-- ROUND(valeur, 1) => à une décimale
SELECT ROUND(AVG(salaire)) AS "salaire_moyen" FROM employes;

-- COUNT() permet de compter le nombre de lignes d'une requête
-- Le nombre d'employés dans l'entreprise : 
-- On mettra toujours * dans les parenthèses de COUNT(), pourquoi ? Parceque comme ça on est sûr de compter l'intégralité des lignes d'une requête
-- Si on met plutôt le nom d'un champ entre ses parenthèses et que le champ a pour valeur "NULL" sur certains enregistrements, ils ne seront pas comptés ! 
-- Si on veut faire ça, c'est une meilleure pratique de mettre une condition WHERE le champ en question IS NOT NULL plutôt que de s'attendre à ce que le COUNT() le gère seul 
SELECT COUNT(*) AS nombre_employes FROM employes;
+-----------------+
| nombre_employes |
+-----------------+
|              20 |
+-----------------+

-- MIN() & MAX() 
-- Salaire minimum 
SELECT MIN(salaire) FROM employes;
+--------------+
| MIN(salaire) |
+--------------+
|         1390 |
+--------------+
-- Salaire maximum
SELECT MAX(salaire) FROM employes;
+--------------+
| MAX(salaire) |
+--------------+
|         5000 |
+--------------+

-- EXERCICE : Affichez le salaire minimum ainsi que le prenom de l'employé ayant ce salaire 
    -- Vérifiez bien vos résultats :)
SELECT prenom, MIN(salaire) FROM employes;
-- La requete se lance bien mais le resultat est faux !  
+-------------+--------------+
| prenom      | MIN(salaire) |
+-------------+--------------+
| Jean-pierre |         1390 |
+-------------+--------------+
-- La fonction d'agreg bloque le résultat à une seule ligne, le système ne fait pas le lien entre le prenom et le min salaire, il me sort simplement le premier prénom trouvé ! 


-- 2 solutions : 

-- 1 : Avec un order by et un limit 
SELECT prenom, salaire FROM employes ORDER BY salaire LIMIT 1;
+--------+---------+
| prenom | salaire |
+--------+---------+
| Julien |    1390 |
+--------+---------+

-- 2 : Avec une requête imbriquée 
SELECT prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);
+--------+---------+
| prenom | salaire |
+--------+---------+
| Julien |    1390 |
+--------+---------+

-- IN & NOT IN pour tester plusieurs valeurs 
-- Affichage des employés des services commercial et comptabilite 
SELECT * FROM employes WHERE service = "commercial" OR service = "comptabilite";
SELECT * FROM employes WHERE service IN ("commercial", "comptabilite");
+-------------+-----------+---------+------+--------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service      | date_embauche | salaire |
+-------------+-----------+---------+------+--------------+---------------+---------+
|         388 | Clement   | Gallet  | m    | commercial   | 2010-12-15    |    2300 |
|         415 | Thomas    | Winter  | m    | commercial   | 2011-05-03    |    3550 |
|         509 | Fabrice   | Grand   | m    | comptabilite | 2011-12-30    |    2900 |
|         547 | Melanie   | Collier | f    | commercial   | 2012-01-08    |    3100 |
|         627 | Guillaume | Miller  | m    | commercial   | 2012-07-02    |    1900 |
|         655 | Celine    | Perrin  | f    | commercial   | 2012-09-10    |    2700 |
|         933 | Emilie    | Sennard | f    | commercial   | 2017-01-11    |    1800 |
+-------------+-----------+---------+------+--------------+---------------+---------+
SELECT * FROM employes WHERE service NOT IN ("commercial", "comptabilite");

-- Plusieurs conditions : AND 
-- On veut un employé du service commercial avec un salaire inférieur ou égal à 2000
SELECT * FROM employes 
WHERE service = "commercial" 
AND salaire <= 2000;
+-------------+-----------+---------+------+------------+---------------+---------+
| id_employes | prenom    | nom     | sexe | service    | date_embauche | salaire |
+-------------+-----------+---------+------+------------+---------------+---------+
|         627 | Guillaume | Miller  | m    | commercial | 2012-07-02    |    1900 |
|         933 | Emilie    | Sennard | f    | commercial | 2017-01-11    |    1800 |
+-------------+-----------+---------+------+------------+---------------+---------+

-- L'un ou l'autre d'un ensemble de conditions : OR 
-- EXERCICE : employes du service production ayant un salaire égal à 1900 ou 2300 
-- Vérifiez les résultats... :) 
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR salaire = 2300;
-- Probleme, il fait la liaison entre les deux premières conditions séparées par le AND, mais celle après le OR il la gère de manière indépendante 
+-------------+---------+--------+------+------------+---------------+---------+
| id_employes | prenom  | nom    | sexe | service    | date_embauche | salaire |
+-------------+---------+--------+------+------------+---------------+---------+
|         388 | Clement | Gallet | m    | commercial | 2010-12-15    |    2300 |
|         417 | Chloe   | Dubar  | f    | production | 2011-09-05    |    1900 |
+-------------+---------+--------+------+------------+---------------+---------+

-- Plusieurs solutions : 
SELECT * FROM employes WHERE service = "production" AND salaire = 1900 OR service = "production" AND salaire = 2300;
SELECT * FROM employes WHERE service = "production" AND (salaire = 1900 OR salaire = 2300);
SELECT * FROM employes WHERE service = "production" AND salaire IN (1900, 2300);
+-------------+--------+-------+------+------------+---------------+---------+
| id_employes | prenom | nom   | sexe | service    | date_embauche | salaire |
+-------------+--------+-------+------+------------+---------------+---------+
|         417 | Chloe  | Dubar | f    | production | 2011-09-05    |    1900 |
+-------------+--------+-------+------+------------+---------------+---------+


-- GROUP BY pour regrouper selon un ou des champs pour permettre l'utilisation de fonction d'agregation plusieurs fois sur un meme jeu de résultat 

-- Nombre d'employés par service 
SELECT COUNT(*) as nombre_employes, service FROM employes;
-- Ici résultat incorrect le système ne fait pas de lien entre le COUNT et le service, il compte simplement toutes les lignes et fait apparaitre à côté le premier service qu'il trouve

-- Avec GROUP BY, il est possible d'appliquer le COUNT() pour plusieurs parties du jeu de résultat
-- Là le but étant de "regrouper" par service, ce qui appliquera automatiquement la fonction d'agrégation sur chaque groupe 
SELECT COUNT(*) as nombre_employes, service FROM employes GROUP BY service;
+-----------------+---------------+
| nombre_employes | service       |
+-----------------+---------------+
|               2 | direction     |
|               6 | commercial    |
|               2 | production    |
|               3 | secretariat   |
|               1 | comptabilite  |
|               3 | informatique  |
|               1 | communication |
|               1 | juridique     |
|               1 | assistant     |
+-----------------+---------------+

SELECT * FROM employes ORDER BY service;
-- Le Group By divise le jeu de résultat par "groupe" tel que vu ci dessous
-- Si une fonction d'agrégation est appellée, elle s'appliquera automatiquement sur chacun des groupes
-- Ce qui fait sauter la limitation d'une fonction d'agrégation de nous retourner uniquement une ligne de résultat
-- Ici elle retournera une ligne par groupe !
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+

|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |

|         388 | Clement     | Gallet   | m    | commercial    | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter   | m    | commercial    | 2011-05-03    |    3550 |
|         547 | Melanie     | Collier  | f    | commercial    | 2012-01-08    |    3100 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2012-07-02    |    1900 |
|         655 | Celine      | Perrin   | f    | commercial    | 2012-09-10    |    2700 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2017-01-11    |    1800 |

|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |

|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |

|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |

|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |

|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |

|         417 | Chloe       | Dubar    | f    | production    | 2011-09-05    |    1900 |
|         900 | Benoit      | Lagarde  | m    | production    | 2016-06-03    |    2550 |

|         491 | Elodie      | Fellier  | f    | secretariat   | 2011-11-22    |    1600 |
|         699 | Julien      | Cottet   | m    | secretariat   | 2013-01-05    |    1390 |
|         739 | Thierry     | Desprez  | m    | secretariat   | 2013-07-17    |    1500 |
+-------------+-------------+----------+------+---------------+---------------+---------+


------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- REQUETES D'INSERTION ------------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- Requête d'insertion dans la BDD 
-- On cite tous les champs ainsi que les valeurs que l'on souhaite y insérer
INSERT INTO employes (id_employes, prenom, nom, salaire, sexe, service, date_embauche) VALUES (NULL, "Pierral", "Lacaze", 12000, "m", "web", CURDATE());

-- On peut ne pas renseigner la primary key car de toute façon elle est en auto increment ! 
INSERT INTO employes (prenom, nom, salaire, sexe, service, date_embauche) VALUES ("Pierral", "Lacaze", 12000, "m", "web", CURDATE());

-- Il est possible de ne pas préciser les champs dans lesquels on insère. Auquel cas, il faudra forcément indiquer les VALUES de tous les champs et surtout dans le même ordre que les champs de la table 
INSERT INTO employes VALUES (NULL, "Pierral", "Lacaze", "m", "web", CURDATE(), 12000);


------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- REQUETES DE MODIFICATION --------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

-- On modifie le salaire d'un employe 
UPDATE employes SET salaire = 1200 WHERE id_employes = 991;
-- Plusieurs champs modifiés en une seule requête : 
UPDATE employes SET salaire = 1300, service = "informatique" WHERE id_employes = 992;

-- REPLACE 
-- Dans le cas d'un enregistrement non existant, REPLACE se comporte comme un INSERT INTO, attention il faut lui donner aussi un id
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "WEB", CURDATE(), 2000);

-- Si l'enregistrement est déjà existant, on remarque un "2 rows affected", en fait, il supprime l'enregistrement trouvé pour réinsérer à la place 
REPLACE INTO employes VALUES (994, "Polo", "Lolo", "m", "info", CURDATE(), 20000);

-- ATTENTION : NE JAMAIS UTILISER REPLACE ! 
    -- Pourquoi ? En fait, du fait que replace supprime d'abord la ligne, si jamais il existe des relations et des contraintes de suppression en cascade dans notre base, la contrainte va s'activer ! Et cela pourrait induire des suppressions non souhaitées sur le reste de la table ! Très dangereux ! 


------------------------------------------------------------------------------
------------------------------------------------------------------------------
-------------- REQUETES DE SUPPRESSION ---------------------------------------
------------------------------------------------------------------------------
------------------------------------------------------------------------------

DELETE FROM employes; -- Cette requête supprime toutes les données de la table 

-- Suppression d'un élément via une condition WHERE
DELETE FROM employes WHERE id_employes = 991;

DELETE FROM employes WHERE id_employes > 990;

-- On peut mettre en place pour une suppression n'immporte quel type de condition WHERE tout comme on les connait déjà depuis nos requêtes SELECT 

-- Tous les enregistrements trouvés sont supprimés 

--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- EXERCICES :
--------------------------------------------------------------------------
--------------------------------------------------------------------------
-- 1 -- Afficher la profession de l'employé 547.
-- 2 -- Afficher la date d'embauche d'Amandine.	
-- 3 -- Afficher le nom de famille de Guillaume	
-- 4 -- Afficher le nombre de personne ayant un n° id_employes commençant par le chiffre 5.	
-- 5 -- Afficher le nombre de commerciaux.
-- 6 -- Afficher le salaire moyen des informaticiens 
-- 7 -- Afficher les 5 premiers employés après avoir classé leur nom de famille par ordre alphabétique. 
-- 8 -- Afficher le coût des commerciaux sur 1 année.		
-- 9 -- Afficher le salaire moyen par service.
-- 10 -- Afficher le nombre de recrutement sur l'année 2010
-- 11 -- Afficher le salaire moyen appliqué lors des recrutements sur la période allant de 2015 a 2017
-- 12 -- Afficher le nombre de service différent 
-- 13 -- Afficher tous les employés sauf ceux du service production et secrétariat
-- 14 -- Afficher conjointement le nombre d'homme et de femme dans l'entreprise
-- 15 -- Afficher les commerciaux ayant été recrutés avant 2012 de sexe masculin et gagnant un salaire supérieur a 2500 €
-- 16 -- Qui a été embauché en dernier 
-- 17 -- Afficher les informations sur l'employé du service commercial gagnant le salaire le plus élevé 
-- 18 -- Afficher le prénom du comptable gagnant le meilleur salaire
-- 19 -- Afficher le prénom de l'informaticien ayant été recruté en premier  
-- 20 -- Augmenter chaque employé de 100 €
-- 21 -- Supprimer les employés du service secrétariat


SELECT service FROM employes WHERE id_employes = 547;
+------------+
| service    |
+------------+
| commercial |
+------------+

SELECT date_embauche FROM employes WHERE prenom = "Amandine";
+---------------+
| date_embauche |
+---------------+
| 2014-01-23    |
+---------------+

SELECT nom FROM employes WHERE prenom = "Guillaume";
+--------+
| nom    |
+--------+
| Miller |
+--------+

SELECT COUNT(*) AS nbr_personne FROM employes WHERE id_employes LIKE "5%";
+----------+
|nbr_personne|
+----------+
|        3 |
+----------+

SELECT COUNT(*) AS nbr_commercial FROM employes WHERE service = "commercial";
+------------------+
| nbr_commercial   |
+------------------+
|        6 |
+----------+

SELECT ROUND(AVG(salaire), 2) AS avg_salaire_informatique FROM employes WHERE service = "informatique";
+-----------------------------+
| avg_salaire_informatique    |
+-----------------------------+
| 2616.67                     |
+-----------------------------+

SELECT * FROM employes ORDER BY nom LIMIT 5;
+-------------+---------+----------+------+--------------+---------------+---------+
| id_employes | prenom  | nom      | sexe | service      | date_embauche | salaire |
+-------------+---------+----------+------+--------------+---------------+---------+
|         592 | Laura   | Blanchet | f    | direction    | 2012-05-09    |    4500 |
|         854 | Daniel  | Chevel   | m    | informatique | 2015-09-28    |    3100 |
|         547 | Melanie | Collier  | f    | commercial   | 2012-01-08    |    3100 |
|         699 | Julien  | Cottet   | m    | secretariat  | 2013-01-05    |    1390 |
|         739 | Thierry | Desprez  | m    | secretariat  | 2013-07-17    |    1500 |
+-------------+---------+----------+------+--------------+---------------+---------+

SELECT SUM(salaire * 12) FROM employes WHERE service = "commercial";
+-------------------+
| SUM(salaire * 12) |
+-------------------+
|            184200 |
+-------------------+


SELECT service, ROUND(AVG(salaire), 2) AS avg_salaire FROM employes GROUP BY service;
+---------------+------------------------+
| service       | avg_salaire            |
+---------------+------------------------+
| direction     |                   4750 |
| commercial    |                2558.33 |
| production    |                   2225 |
| secretariat   |                1496.67 |
| comptabilite  |                   2900 |
| informatique  |                2616.67 |
| communication |                   2100 |
| juridique     |                   3550 |
| assistant     |                   1775 |
+---------------+------------------------+

SELECT COUNT(*) AS nbr_embauches_2010 FROM employes WHERE YEAR(date_embauche) = 2010;
+---------------------+
| nbr_embauches_2010 |
+---------------------+
|                   2 |
+---------------------+

SELECT AVG(ROUND(salaire, 2)) FROM employes WHERE date_embauche BETWEEN "2015-01-01" AND "2017-12-31";
+------------------+
| AVG(ROUND(salaire, 2)) |
+------------------+
| 2616.67 |
+------------------+

SELECT COUNT(DISTINCT service) FROM employes;
+----------------------+
| COUNT(DISTINCT service) |
+----------------------+
|                    9 |
+----------------------+

SELECT * FROM employes WHERE service NOT IN ("production", "secretariat");
+-------------+-------------+----------+------+---------------+---------------+---------+
| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
+-------------+-------------+----------+------+---------------+---------------+---------+
|         350 | Jean-pierre | Laborde  | m    | direction     | 2010-12-09    |    5000 |
|         388 | Clement     | Gallet   | m    | commercial    | 2010-12-15    |    2300 |
|         415 | Thomas      | Winter   | m    | commercial    | 2011-05-03    |    3550 |
|         509 | Fabrice     | Grand    | m    | comptabilite  | 2011-12-30    |    2900 |
|         547 | Melanie     | Collier  | f    | commercial    | 2012-01-08    |    3100 |
|         592 | Laura       | Blanchet | f    | direction     | 2012-05-09    |    4500 |
|         627 | Guillaume   | Miller   | m    | commercial    | 2012-07-02    |    1900 |
|         655 | Celine      | Perrin   | f    | commercial    | 2012-09-10    |    2700 |
|         701 | Mathieu     | Vignal   | m    | informatique  | 2013-04-03    |    2500 |
|         780 | Amandine    | Thoyer   | f    | communication | 2014-01-23    |    2100 |
|         802 | Damien      | Durand   | m    | informatique  | 2014-07-05    |    2250 |
|         854 | Daniel      | Chevel   | m    | informatique  | 2015-09-28    |    3100 |
|         876 | Nathalie    | Martin   | f    | juridique     | 2016-01-12    |    3550 |
|         933 | Emilie      | Sennard  | f    | commercial    | 2017-01-11    |    1800 |
|         990 | Stephanie   | Lafaye   | f    | assistant     | 2017-03-01    |    1775 |
+-------------+-------------+----------+------+---------------+---------------+---------+

SELECT sexe, COUNT(*) FROM employes GROUP BY sexe;
+------+----------+
| sexe | COUNT(*) |
+------+----------+
| m    |       11 |
| f    |        9 |
+------+----------+

SELECT * FROM employes WHERE service = "commercial" AND date_embauche < "2012-01-01" AND sexe = "m" AND salaire > 2500;
+-------------+--------+--------+------+------------+---------------+---------+
| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
+-------------+--------+--------+------+------------+---------------+---------+
|         415 | Thomas | Winter | m    | commercial | 2011-05-03    |    3550 |
+-------------+--------+--------+------+------------+---------------+---------+

SELECT * FROM employes ORDER BY date_embauche DESC LIMIT 1;
+-------------+-----------+--------+------+-----------+---------------+---------+
| id_employes | prenom    | nom    | sexe | service   | date_embauche | salaire |
+-------------+-----------+--------+------+-----------+---------------+---------+
|         990 | Stephanie | Lafaye | f    | assistant | 2017-03-01    |    1775 |
+-------------+-----------+--------+------+-----------+---------------+---------+

SELECT * FROM employes WHERE service = "commercial" ORDER BY salaire DESC LIMIT 1;
+-------------+--------+--------+------+------------+---------------+---------+
| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
+-------------+--------+--------+------+------------+---------------+---------+
|         415 | Thomas | Winter | m    | commercial | 2011-05-03    |    3550 |
+-------------+--------+--------+------+------------+---------------+---------+

SELECT prenom FROM employes WHERE service = "comptabilite" ORDER BY salaire DESC LIMIT 1;
+---------+
| prenom  |
+---------+
| Fabrice |
+---------+

SELECT prenom FROM employes WHERE service = "informatique" ORDER BY date_embauche ASC LIMIT 1;
+---------+
| prenom  |
+---------+
| Mathieu |
+---------+

UPDATE employes SET salaire = salaire + 100;
Rows matched: 20  Changed: 20  Warnings: 0

DELETE FROM employes WHERE service = "secretariat";
Query OK, 3 rows affected 