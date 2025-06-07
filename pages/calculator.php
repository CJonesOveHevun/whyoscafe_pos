<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
    <?php
    require_once '../backend/db_connect.php';
    $collections = $client->selectCollection($dbname,'inventory');
    $items = $collections->find();
    ?>
    <main>
        <div class="topbar">
            <div>
                <h2>Ingredients Calculator</h2>
                <p class="dashboard-subtitle">Calculate precise ingredient measurements for your beverages</p>
            </div>

            <div class="notif">
                <div class="notifications">
                    <span class="bell">🔔</span>
                    <span class="badge">3</span>
                </div>
                <div class="datetime">
                    <span class="date"><?php echo date('F j, Y'); ?></span>
                    <span class="time"><?php echo date('h:i A'); ?></span>
                </div>
                    
            </div>
            
        </div>
        
        <div class="content-grid">
            <form id="recipeForm" class="card">
                <h2>Recipe Calculator</h2>
                <label for="recipe">Select Recipe</label>
                <select id="recipe" name="recipe">
                    <option value="iced_caramel_latte">Iced Caramel Latte</option>
                </select>

                <label for="servings">Number of Servings</label>
                <input type="number" id="servings" name="servings" min="1" value="1" />
                <button class="btn-primary" type="submit">Calculate Recipe</button>

            </form>
            <script>
                document.getElementById("recipeForm").addEventListener("submit", function(e) {
                e.preventDefault();
                let recipe = document.getElementById("recipe").value;
                let servings = document.getElementById("servings").value;
                
                fetch("../recipe_calc.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `recipe=${encodeURIComponent(recipe)}&servings=${encodeURIComponent(servings)}`
                }).then(Response => Response.text())
                .then(data => {
                    document.getElementById("results").innerHTML = data;
                }).catch(err =>{
                    document.getElementById("results").innerHTML = "An error has occured";
                    console.error("error: ", error);
                })
            
            });
            </script>

            <div class="card" id="resultContainer" style="margin-top:1rem;">
                <h2>Calculation Results</h2>
                <div id="results">Select a recipe and calculate to see results</div>
            </div>

            <!-- Ingredient Inventory -->
            <section class="card inventory">
                <h2>Ingredient Inventory</h2>
                <ul class="ul-form">
                    <?php foreach ($items as $item): ?>
                    <li><strong><?php echo htmlspecialchars($item['name'])?></strong> — <?php echo htmlspecialchars($item['stock']) . ' ' . htmlspecialchars($item['unit'])?></li> 
                    <?php endforeach; ?>
                </ul>
            </section>

            <!-- Unit Converter -->
            <section class="card converter">
                <h2>Unit Converter</h2>
                <label>From</label>
                <input type="number" placeholder="Amount" id="inp_convert"/>
                <select id="fromUnit">
                    <option value="grams">grams (g)</option>
                    <option value="kilograms">kilograms (kg)</option>
                    <option value="milliliters">milliliters (ml)</option>
                    <option value="liters">liters (L)</option>
                </select>

                <label>To</label>
                <select id="ToUnit">
                    <option value="grams">grams (g)</option>
                    <option value="kilograms">kilograms (kg)</option>
                    <option value="milliliters">milliliters (ml)</option>
                    <option value="liters">liters (L)</option>
                    <option value="tablespoons">tablespoons (tbs)</option>
                </select>

                <p class="conversions" id="unitResults"></p>
                
            </section>
        </div>
        
    </main>
</div>
<script src="../pages/converter.js"></script>
</body>
</html>