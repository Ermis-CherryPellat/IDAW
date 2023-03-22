# IDAW

— GET /users.php
    — paramètre : aucun
            - exemple : GET http://localhost:8888/tp4exo5/users.php
    — résultat : retourne tous les utilisateurs de la base (JSON)

— POST /users.php
    — paramètre : tous les champs de l’utilsateur à créer (name, email) sauf le champ id qui sera automatique affecté par le serveur
        - exemple : POST -d '{"nom":"bob","email":"baobab@mail.com"}'  http://localhost:8888/tp4exo5/users.php
    — résultat : retourne le code de statut HTTP 201 (Created) et le champ Location de l’en- tête HTTP doit contenir l’URL de la nouvelle ressource donc son identifiant, exemple : Location: /user.php/5 et le corps de la réponse, toutes les infos de l’utilisateur créé au format JSON

— PUT et PATCH /users.php
    — paramètre : tous les champs de l’utilsateur à modifier (id_user, name, email) 
        - exemple : PATCH -d '{"id_user":"49","nom":"babobab","email":"baobab@mail.com"}'  http://localhost:8888/tp4exo5/users.php
    — résultat : retourne le code de statut HTTP 200 OK et le champ Location de l’en- tête HTTP doit contenir l’URL de la nouvelle ressource donc son identifiant, exemple : Location: /user.php/5 et le corps de la réponse, toutes les infos de l’utilisateur modifié au format JSON

— DELETE /users.php
    — paramètre : l'id de l’utilsateur à modifier (id_user) 
        - exemple : DELETE -d '{"id_user":"49"}'  http://localhost:8888/tp4/exo5/users.php
    — résultat : retourne le code de statut HTTP 204 No Content



.
