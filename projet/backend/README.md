# Backend du site I Manger Mieux

## API REST

## API users.php =======================

| Action | Méthode HTTP | Payload | URL | Description |
------

| Read       | GET     |         | /users.php    |  Retourne tous les utilisateurs de la base de données           |

|   Read     |   GET   |         | /users.php?id_utilisateur=    | Retourne l'utilisateur dont le login est spécifié            |  

|   Create     |  POST    | curl -X POST -H "Content-Type: application/json" 
-d "{\"nom\":\"Doe\",\"prenom\":\"John\",\"email\":\"johndoe@example.com\",\"mot_de_passe\":\"123456\",\"id_sexe\":\"1\",\"id_poids\":\"2\",\"id_taille\":\"1\",\"id_objectif\":\"2\",\"id_pratique_sportive\":\"1\",\"id_tranche_age\":\"2\"}" http://localhost/Ermis/IDAW/projet/backend/users.php        |  /users.php   |  Créer un utilsateur avec ses infomrations            |

|  Delete     |  DELETE    |  {id_utilisateur:}   | /user.php                    | Supprimer un utilsateur spécifié par son id |


## API types_de_repas.php =======================

On utilise cette API pour selectionner le type de repas dans le form qui permet d'ajouter un repas, ainsi que dans l'historique des repas.

| Action | Méthode HTTP | Payload | URL | Description |
------

|   Read     |   GET   |         | /type_de_repas.php    | Retourne les types de repas (id et nom)           |  

Réponse: [{"id_type_repas":0,"nom_type_repas":"Petit dejeuner"},{"id_type_repas":1,"nom_type_repas":"Dejeuner"},{"id_type_repas":2,"nom_type_repas":"Gouter"},{"id_type_repas":3,"nom_type_repas":"Diner"}]



## API type_aliment.php =======================

On utilise cette API pour selectionner/afficher le type du aliment

| Action | Méthode HTTP | Payload | URL | Description |
------

|   Read     |   GET   |         | /type_aliment.php    | Retourne les types d'aliment (id et nom)           |  

Réponse: [{"id_type_aliment":13,"nom_type_aliment":"entr\u00e9es et plats compos\u00e9s"},{"id_type_aliment":14,"nom_type_aliment":"fruits, l\u00e9gumes, l\u00e9gumineuses et ol\u00e9agineux"},{"id_type_aliment":15,"nom_type_aliment":"produits c\u00e9r\u00e9aliers"},{"id_type_aliment":16,"nom_type_aliment":"viandes, \u0153ufs, poissons et assimil\u00e9s"},{"id_type_aliment":17,"nom_type_aliment":"produits laitiers et assimil\u00e9s"},{"id_type_aliment":18,"nom_type_aliment":"eaux et autres boissons"},{"id_type_aliment":19,"nom_type_aliment":"produits sucr\u00e9s"},{"id_type_aliment":20,"nom_type_aliment":"glaces et sorbets"},{"id_type_aliment":21,"nom_type_aliment":"mati\u00e8res grasses"},{"id_type_aliment":22,"nom_type_aliment":"aides culinaires et ingr\u00e9dients divers"},{"id_type_aliment":23,"nom_type_aliment":"aliments infantiles"},{"id_type_aliment":24,"nom_type_aliment":"p\u00e2tes et farines"}]

## API repas.php =======================

On utilise cette API afin de lire/ajouter les repas d'un utilisateur.

| Action | Méthode HTTP | Payload | URL | Description |
------

|   Read     |   GET   |   mettre l'id_utilisateur en méthode GET dans le chemin     | /repas.php?id_utilisateur=    | Retourne les repas d'un utilisateur spécifié par son id (id_repas,	id_utilisateur,	id_type_repas, date_consommation)           |  

|   Create     |  POST    | 
'{"id_utilisateur":INT,"id_type_repas":INT,"date_consommation":DATETIME}'      |  /repas.php   |  Créer un repas pour un utilisateur         |

|   Update     |  PUT    | 
'{"id_utilisateur":INT,"id_type_repas":INT,"date_consommation":DATETIME}'      |  /repas.php   |  Modifier un repas, le repas est modifié en fonction de l'id_repas         |

|  Delete     |  DELETE    |  '{"id_repas":INT}'   | /repas.php                    | Supprimer un utilsateur spécifier avec son id |



## API aliments.php =======================

On utilise cette API afin de ajouter/modifier/supprimer un aliment et lire les aliments d'un repas.

| Action | Méthode HTTP | Payload | URL | Description |
------

|   Read     |   GET   |         | /aliment.php  | Retourne les aliments avec leurs informations (id_aliment, nom_aliment, nom_type_aliment, glucides, lipides, sucres, proteines, fibres, energie)        |  

|   Create     |  POST    | 
'{"nom_aliment":VARCHAR(200),"id_type_aliment":INT,"glucides":INT,"lipides":INT,"sucres":INT,"proteines":INT,"fibres":INT,"energie":INT}'      |  /aliments.php   |  Créer un aliment        |

|   Update     |  PUT    | 
'{"nom_aliment":VARCHAR(200),"id_type_aliment":INT,"glucides":INT,"lipides":INT,"sucres":INT,"proteines":INT,"fibres":INT,"energie":INT}'       |  /aliments.php   |  Modifier un aliment, l'aliment est modifié en fonction de l'id_repas         |

|  Delete     |  DELETE    |  '{"id_aliment":INT}'   | /aliments.php                    | Supprimer un aliment spécifié par son id |

## API aliment_consomme.php =======================

On utilise cette API afin de ajouter/modifier/supprimer un aliment consommé et lire les aliments consommés d'un repas.

| Action | Méthode HTTP | Payload | URL | Description |
------

|   Read     |   GET   |         | /aliment_consomme.php  | Retourne les aliments consommés pendant des repas avec leurs informations (id_aliment, id_repas, masse)        |  

|   Create     |  POST    |     '{"id_aliment":INT,"id_repas":INT,"masse":INT}'      |  /aliment_consomme.php   |  Créer un aliment consomme pour un repas        |

|   Update     |  PUT    | 
'{"id_aliment":INT,"id_repas":INT,"masse":INT}'       |  /aliment_consomme.php   |  Modifier un aliment, l'aliment est modifié en fonction de l'id_repas et de l'id_aliment       |

|  Delete     |  DELETE    |  '{"id_aliment":INT,"id_repas";INT}'   | /aliment_consomme.php                    | Supprimer un aliment spécifié par son id_repas et son id_aliment |

## API nutriments.php =======================

On utilise cette API pour récuperer les moyennes quotidiennes de chaque nutriments consommé par un utilisateur.

| Action | Méthode HTTP | Payload | URL | Description |
------

|   Read     |   GET   |     mettre l'id_utilisateur en méthode GET dans le chemin    | /nutriments.php?id_utilisateur=    | Retourne les moyennes quotidiennes de chaque nutriment consommé par un utilisateur         |  

Réponse: [{"avg_glucides":"0.02600000","avg_lipides":"0.02600000","avg_sucres":"0.00000000","avg_proteines":"0.00000000","avg_fibres":"0.00000000","avg_energie":"0.00000000"}] 