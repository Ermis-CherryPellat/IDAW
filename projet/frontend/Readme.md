# Front-end 
Le Front end est l'interface utilisateur que les utilisateurs voient et avec laquelle ils interagissent directement. 

## Page de login

Se connecter à un compte iMangerMieux . Il faut y entrer son email utilisateur et son mot de passe. En cliquant sur se connecter une nouvelle session est créée. Cette session  dure 1h. Et ensuite, l'utilsateur est déconnecté. 

!!!Mettre un exemple de compte à utiliser (compte qui à déjà un historique de repas)!!!

## Page de création d'un compte

Permet de créer un compte utilsateur en y entrant toutes ses information personnelles comme: 
un email pour se connecter,
un mot de passe pour se connecter,
le nom, 
le prénom, 
la tranche d'âge, 
le sexe, 
le tranche de poids (en kg), 
la tranche de taille (en cm),
l'objectif sportif (prise de poids, maintien de la forme ou perte de poids)
la pratique sportive (régulière, auccune pratique ou souvent)

## Page utilisateur 

Page du profil de l'utilisateur. Permet d'observer toutes les informations personnelles. 
A ajouter : supression du compte et modification des informations personnelles comme le poids ou le mot de passe ou l'email (non prioritaire pour l'instant)

## Page des repas

Page qui permet de voir l'historique de ses repas et leurs contenus consommés ainsi qu'ajouter de nouveaux repas.
Les repas sont liés à l'utilisateur de la session.

Nous n'avons pas réussi à supprimer/modifier des repas en raison de souci avec les contraintes de clés étrangères. Nous avons essayé plusieurs méthodes pour contourner/enlever ces contraintes mais ça n'a pas abouti...

## Page des aliments

Page qui permet d'afficher une liste d'aliments dans un tableau DataTable.
Possibilité aussi sur cette page d'ajouts, de modifications et supressions d'aliments.

## Page de dashboard/analyse
!! Gros problème avec l'affichage du diagramme impossible à résoudre !!
Dans ce board, on a accès au suivi de son activité nutrtionnel.
Il y a la tranche de poids actuel et l'IMC actuel acalculé en fonction de la taille, du poids et du sexe.
On peut observer son objectif de calories quotidien et ses calories consommées moyennes par jour pourse rendre compte si l'utilisateru consomme assez de calories avec son almentation. Les objectifs quotidiens sont calculé avec un efonction javascript en fonction de la pratique sportive, le pois, lâ taille et le sexe.

Enfin on a  un diagramme pour indiquer les objectids nutriments du jours : sucres, fibre, protéines , lipides et glucides. Ce sontd es barres. Ce sont des barres de pourcentages , comme des jauges qui montent en fonction des nutriments consommés , jusqu'aux objectifs uotidiens , toujours claculés en fonction d ela pratique sportivr, taille , sexe et poids. 


