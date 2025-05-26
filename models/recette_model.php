<?php
// Toutes les fonctions relatives à l'appel de la table recette dans la base de données

require_once __DIR__.'/../models/db_connect.php';

// Create

// Read
function get_recette_by_id($id) {
    $url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i=$id";
    $response = file_get_contents($url);
    if ($response === false) {
        return null;
    }
    $data = json_decode($response, true);
    return $data['meals'][0] ?? null;
}

function list_recette_by_filters($vegetarien, $vegan, $sans_gluten, $sans_lactose, $halal) {
    $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=";
    $response = file_get_contents($url);
    if ($response === false) {
        return [];
    }
    $data = json_decode($response, true);
    if (!isset($data['meals']) || $data['meals'] === null) {
        return [];
    }
    $filtered = [];
    foreach ($data['meals'] as $meal) {
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

// Update

// Delete
