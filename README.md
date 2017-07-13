# API php via framework Silex

Comment l'installer :
- Récupérer le projet
- Insérer une table dans votre base de donnée via le sql dans le repertoire db
- Mettre à jour le fichier app/config/prod.php
- Faire un composer update à la racine du projet

Description :
- Framework PHP Silex 2.0
- Doctrine pour la gestion base de donnée
- Firebase pour la génération de token
- Swagger UI (à la racine du projet) pour la description de l'api via le fichier en yaml à la racine

Fonctionnement de l'api :
- La route est recherché dans app/get.php & post.php chaque route pointe vers un controleur et son action
- Le controlleur et son action situé dans app/src/Controller sont appelés et appellent la méthode du model 
- La méthode du model situé dans app/src/Classes est executé et renvois le résultat au controlleur qui génère le json
- Ils convient de déclarer chaque model que l'on désire utiliser dans app/app.php 