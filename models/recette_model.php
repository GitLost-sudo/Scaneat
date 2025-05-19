<?php
// Toutes les fonctions relatives à l'appel de la table recette dans la base de données

require_once __DIR__.'/../models/db_connect.php';

// Create

// Read
function read_recette_by_id($id) {
    $url = "https://www.themealdb.com/api/json/v1/1/lookup.php?i=" . urlencode($id);
    $response = file_get_contents($url);
    if ($response === false) {
        return null;
    }
    $data = json_decode($response, true);
    if (isset($data['meals']) && $data['meals'] !== null) {
        return $data['meals'][0];
    }
    return null;
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
        $category = strtolower($meal['strCategory']);

        // Filtres végétarien/vegan (exclure viande/poisson)
        if ($vegetarien || $vegan) {
            if (
                in_array($category, ['beef', 'chicken', 'seafood', 'pork', 'lamb', 'goat', 'fish']) ||
                in_array('beef', $ingredients) ||
                in_array('chicken', $ingredients) ||
                in_array('pork', $ingredients) ||
                in_array('lamb', $ingredients) ||
                in_array('goat', $ingredients) ||
                in_array('fish', $ingredients) ||
                in_array('herring', $ingredients) // exemple pour la recette fournie
            ) {
                continue;
            }
        }
        // Vegan : exclure oeufs, lait, fromage, beurre, miel
        if ($vegan) {
            if (
                in_array('egg', $ingredients) ||
                in_array('milk', $ingredients) ||
                in_array('cheese', $ingredients) ||
                in_array('butter', $ingredients) ||
                in_array('honey', $ingredients)
            ) {
                continue;
            }
        }
        // Sans gluten : exclure pain, farine, pâtes, etc.
        if ($sans_gluten) {
            if (
                in_array('bread', $ingredients) ||
                in_array('flour', $ingredients) ||
                in_array('pasta', $ingredients) ||
                in_array('noodles', $ingredients)
            ) {
                continue;
            }
        }
        // Sans lactose : exclure lait, fromage, beurre, crème
        if ($sans_lactose) {
            if (
                in_array('milk', $ingredients) ||
                in_array('cheese', $ingredients) ||
                in_array('butter', $ingredients) ||
                in_array('cream', $ingredients)
            ) {
                continue;
            }
        }
        // Halal : exclure porc, alcool
        if ($halal) {
            if (
                in_array('pork', $ingredients) ||
                in_array('bacon', $ingredients) ||
                in_array('ham', $ingredients) ||
                in_array('wine', $ingredients) ||
                in_array('beer', $ingredients) ||
                in_array('rum', $ingredients)
            ) {
                continue;
            }
        }
        $filtered[] = $meal;
    }
    return $filtered;
}

// Update

// Delete
