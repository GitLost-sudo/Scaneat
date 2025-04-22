# Scan'Eat

## Présentation

**Un scan suffit pour éviter l'oubli !**

Membres du projet :
- Eric LY (Chef de projet)
- Sami BELMIHOUB
- Prince DAKOURI
- Mathis VANHEE

Commanditaire : Quentin VABUTSELE

## Structure du site web : Modèle MVC

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

## Modélisation des données

### MCD
`Modèle Conceptuel de données` de notre base de données SCAN'EAT <br>
> *Le MCD est un modèle de haut niveau qui décrit les entités, les relations et les attributs sans prendre en compte les détails d'implémentation.*
``` mermaid
flowchart
le_produit --> un_produit
marque --> un_produit
catégorie --> le_produit
frigo --> un_produit
frigo --> compte
compte --> favoris
recette --> le_produit
un_produit --> ingredients
favoris --> recette
```

### MLD
`Modèle Logique de données` de notre base de données SCAN'EAT
> *Le MLD est un modèle qui spécifie la structure de la base de données de manière formelle, en utilisant des langages de modélisation tels que le modèle entité-association (ER) ou le modèle relationnel.* 
``` mermaid
erDiagram

le_produit ||--|{ un_produit : possede
marque ||--|{ un_produit : possede
categorie ||--|{ le_produit : possede
frigo ||--|{ un_produit : possede
frigo ||--|{ compte : possede
compte ||--|{ favoris : possede
favoris }o--o{ recette : possede
recette }o--|{ le_produit : possede
un_produit }o--|{ ingredient : possede

recette {
    string name
    int proportion
    int temps
}
le_produit {
    string name
    string categorie
}
un_produit {
    string name
    string le_produit
    string ingredient
    string date_de_peremption
    string date_de_preference
    string nutriscore
}
ingredient {
    string name
}
categorie {
    string name
}
compte{
    string email
    string password
    int frigo
    int favoris
    int un_produit
}
frigo {
    int un_produit
}
favoris {
    int compte
    int recette
}
marque {
    string name
}
```

### MPD
`Modèle Physique de données` de notre base de données SCAN'EAT
> *Le MPD est un modèle qui spécifie comment la base de données sera implémentée dans un système de gestion de base de données spécifique, en utilisant des types de données, des contraintes de clé étrangère, etc.*
``` mermaid
erDiagram

le_produit ||--|{ un_produit : le_produit_id
marque ||--|{ un_produit : marque_id
categorie }|--|{ le_produit_categorie : categorie_id
le_produit_categorie }|--|{ le_produit : le_produit_id
frigo ||--o{ un_produit_frigo : frigo_id
un_produit_frigo }o--o{ un_produit : un_produit_id
frigo ||--|{ compte_frigo : frigo_id
compte_frigo }|--|{ compte : compte_id
compte ||--|{ favoris : compte_id
favoris }o--o{ recette : recette_id
recette }|--|{ le_produit_recette : recette_id
le_produit_recette }o--|{ le_produit : le_produit_id
un_produit ||--|{ un_produit_ingredient : un_produit_id
un_produit_ingredient }|--|{ ingredient : ingredient_id

recette {
    int recette_id
    string name
    int temps
}
le_produit_recette {
    int recette_id
    int le_produit_id
}
le_produit {
    int le_produit_id
    string name
}
un_produit {
    int un_produit_id
    string name
    int le_produit_id
    int marque_id
    int date_de_peremption
    int date_de_preference
    int nutriscore
}
un_produit_ingredient {
    int un_produit_id
    int ingredient_id
}
ingredient {
    int ingredient_id
    string name
}
categorie {
    int categorie_id
    string name
}
le_produit_categorie {
    int le_produit_id
    int categorie_id
}
compte{
    int compte_id
    string email
    string password
}
un_produit_frigo {
    int un_produit_id
    int frigo_id
}
frigo {
    int frigo_id
}
compte_frigo {
    int compte_id
    int frigo_id
}
favoris {
    int compte_id
    int recette_id
}
marque {
    int marque_id
    string name
}
```