Le modèle MVC (Model-View-Controller) sépare les responsabilités de votre application en trois parties distinctes :

- Model : Gère les données et la logique métier (même en PHP procédural, on peut structurer ses fonctions pour isoler la gestion des données).
Le Model gère les données et la logique métier de l'application. En PHP procédural, il s'agit de fonctions et de scripts dédiés à la récupération, au traitement et à la sauvegarde des informations.

Centralisation des règles métier
Séparation claire des données et de la présentation
Facilite la maintenance et l'évolution du code

- View : S'occupe de l'affichage et de la présentation des données à l'utilisateur.
Les Views sont responsables de l'affichage des données à l'utilisateur. Elles contiennent le code HTML et peuvent intégrer des variables issues du Model, sans inclure de logique métier complexe.

Séparation nette entre logique et présentation
Facilite le travail des designers
Permet une mise à jour visuelle sans impacter la logique métier


- Controller : Traite les requêtes de l'utilisateur, interagit avec le model et choisit la vue à afficher.

Le Controller fait le lien entre les requêtes de l'utilisateur, le Model et la View. Il traite les entrées, exécute la logique de l'application et choisit la bonne vue à afficher.

Centralisation du routage et de la logique d'acheminement
Permet une gestion claire des actions utilisateur
Simplifie la communication entre le Model et la View
Typiquement, chaque controller est une route sur lequel les URL pointent. Et correspondent à des logiques métiers.