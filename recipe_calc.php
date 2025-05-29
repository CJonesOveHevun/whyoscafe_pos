<?php
$recipes = [
    "iced_caramel_latte" => [
        "Arabica Coffee Beans" => ["amount" => 10, "unit" => "g"],
        "Caramel Syrup" => ["amount" => 30, "unit" => "ml"],
        "Oat Milk" => ["amount" =>150, "unit" => "ml"],
        "Ice Cubes" => ["amount" => 5, "unit" => "pieces"]
    ]
    ];

$selected_recipe = $_POST['recipe'] ?? '';
$servings = intval($_POST['servings'] ?? 1);
if (isset($recipes[$selected_recipe])) {
    echo "<ul class=\"ul-form\">";
    foreach ($recipes[$selected_recipe] as $ingredient => $info) {
        $total = $info['amount'] * $servings;
        echo "<li>$ingredient: <strong>$total {$info['unit']}</strong></li>";
    }
    echo '</ul class=\"ul-form\">';
} else {
    echo "<p>Recipe not found.</p>";
}
?>