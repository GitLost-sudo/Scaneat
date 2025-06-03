<?php
// Toutes les fonctions relatives à l'appel de la table recette dans la base de données

require_once __DIR__.'/../models/db_connect.php';

// Create

// Read
function list_recette_by_frigo($compte_id) {
    global $db;
    $sql = "SELECT * FROM frigo WHERE compte_id = :compte_id;";
    $stmt = $db->prepare($sql);
    $stmt->execute([ ':compte_id' => $compte_id]);
    $frigo_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $filtered_recipes = [];
    
    foreach ($frigo_items as $item) {
        $nom = strtolower(trim($item['nom']));
        $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=$nom";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if (!isset($data['meals']) || $data['meals'] === null) {
            continue;
        }

        foreach ($data['meals'] as $meal) {
            $ingredients = [];
            for ($i = 1; $i <= 20; $i++) {
                $ing = $meal["strIngredient$i"];
                if ($ing && trim($ing) !== "") {
                    $ingredients[] = strtolower(trim($ing));
                }
            }

            // Si l'ingrédient du frigo est présent dans la recette, on ajoute la recette
            if (in_array($nom, $ingredients)) {
                $filtered_recipes[] = $meal;
            }
        }
    }
    return $filtered_recipes;
}

function filter_recette_by_frigo($response, $compte_id) {
    $data = json_decode($response, true);
    if (!isset($data['meals']) || $data['meals'] === null) {
        return [];
    }
    
    $recettes_frigo = list_recette_by_frigo($compte_id);
    $filtered_recipes = [];
    
    foreach ($data['meals'] as $meal) {
        foreach ($recettes_frigo as $frigo_meal) {
            if ($meal['idMeal'] === $frigo_meal['idMeal']) {
                $filtered_recipes[] = $meal;
                break; // On a trouvé la recette dans le frigo, on peut arrêter la boucle
            }
        }
    }
    
    return $filtered_recipes;
}

function get_recette_by_id($id, $compte_id) {
    $url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i=$id";
    $response = file_get_contents($url);
    if ($response === false) {
        return null;
    }
    $recettes_frigo = list_recette_by_frigo($response, $compte_id);
    // On retourne la première recette trouvée dans le frigo, sinon null
    return $recettes_frigo[0] ?? null;
}

function list_recette_by_filters($vegetarien, $vegan, $sans_gluten, $sans_lactose, $halal, $compte_id) {
    $recettes_frigo = list_recette_by_frigo($compte_id);
    if (empty($recettes_frigo)) {
        return [];
    }
    $filtered = [];
    foreach ($recettes_frigo as $meal) {
        $ingredients = [];
        for ($i = 1; $i <= 20; $i++) {
            $ing = $meal["strIngredient$i"];
            if ($ing && trim($ing) !== "") {
                $ingredients[] = strtolower(trim($ing));
            }
        }

        // Liste des mots-clés à exclure pour chaque filtre
        $meats = ['beef', 'chicken', 'pork', 'lamb', 'goat', 'fish', 'herring'];
        $vegan_exclude = ['egg', 'milk', 'cheese', 'butter', 'honey'];
        $gluten_exclude = ['bread', 'flour', 'pasta', 'noodles'];
        $lactose_exclude = ['milk', 'cheese', 'butter', 'cream'];
        $halal_exclude = ['pork', 'bacon', 'ham', 'wine', 'beer', 'rum'];

        // Fonction utilitaire pour vérifier si un ingrédient contient un mot-clé interdit
        $contains_forbidden = function($ingredients, $keywords) {
            foreach ($ingredients as $ing) {
                foreach ($keywords as $kw) {
                    if (strpos($ing, $kw) !== false) {
                        return true;
                    }
                }
            }
            return false;
        };

        // Filtres végétarien/vegan (exclure viande/poisson)
        if ($vegetarien || $vegan) {
            if ($contains_forbidden($ingredients, $meats)) {
                continue;
            }
        }
        // Vegan : exclure oeufs, lait, fromage, beurre, miel
        if ($vegan) {
            if ($contains_forbidden($ingredients, $vegan_exclude)) {
                continue;
            }
        }
        // Sans gluten : exclure pain, farine, pâtes, etc.
        if ($sans_gluten) {
            if ($contains_forbidden($ingredients, $gluten_exclude)) {
                continue;
            }
        }
        // Sans lactose : exclure lait, fromage, beurre, crème
        if ($sans_lactose) {
            if ($contains_forbidden($ingredients, $lactose_exclude)) {
                continue;
            }
        }
        // Halal : exclure porc, alcool
        if ($halal) {
            if ($contains_forbidden($ingredients, $halal_exclude)) {
                continue;
            }
        }
        $filtered[] = $meal;
    }
    return $filtered;
}

function search_recette($searched_text) {
    $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . urlencode($searched_text);
    $response = file_get_contents($url);
    if ($response === false) {
        return [];
    }
    $data = json_decode($response, true);
    return $data['meals'] ?? [];
}

// Update

// Delete
