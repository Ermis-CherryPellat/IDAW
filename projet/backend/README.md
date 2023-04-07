# Backend du site I Manger Mieux

## API REST
| Action | Méthode HTTP | Payload | URL | Description |
|--------|------|---------|-----|-------------|

| Read       | GET     |         | /users.php    |  Retourne tous les utilisateurs de la base de données           |

|   Read     |   GET   |         | /users.php?id_utilisateur=    | Retourne l'utilsateur dont le login est spécifié            |  

|   Create     |  POST    | curl -X POST -H "Content-Type: application/json" 
-d "{\"nom\":\"Doe\",\"prenom\":\"John\",\"email\":\"johndoe@example.com\",\"mot_de_passe\":\"123456\",\"id_sexe\":\"1\",\"id_poids\":\"2\",\"id_taille\":\"1\",\"id_objectif\":\"2\",\"id_pratique_sportive\":\"1\",\"id_tranche_age\":\"2\"}" http://localhost/Ermis/IDAW/projet/backend/users.php        |  /users.php   |  Créer un utilsateur avec ses infomrations            |

|  Delete     |  DELETE    |  {id_utilisateur:}   | /utilsateur.php                    | Supprimer un utilsateur spécifier avec son id |




## Titre 