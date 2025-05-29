<?php include 'header.php'; ?>
<div class="container">
    <?php include 'sidebar.php'; ?>
    <main>
        <h1>Ingredients Calculator</h1>
        <p class="subtitle">Calculate precise ingredient measurements for your beverages</p>
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
                
                fetch("recipe_calc.php", {
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
                <ul>
                    <li><strong>Arabica Coffee Beans</strong> — 15.500 kg</li>
                    <li><strong>Caramel Syrup</strong> — 2.100 L</li>
                    <li><strong>Croissants</strong> — 50,000 pieces</li>
                    <li><strong>Oat Milk</strong> — 8.500 L</li>
                    <li><strong>Paper Cups</strong> — 500,000 pieces</li>
                </ul>
            </section>

            <!-- Unit Converter -->
            <section class="card converter">
                <h2>Unit Converter</h2>
                <label>From</label>
                <input type="number" placeholder="Amount" />
                <select>
                    <option>grams (g)</option>
                    <option>liters (L)</option>
                </select>

                <label>To</label>
                <select>
                    <option>kilograms (kg)</option>
                    <option>milliliters (ml)</option>
                </select>

                <div class="conversions">
                    <p>1 kg = 1,000 g</p>
                    <p>1 L = 1,000 ml</p>
                    <p>1 cup ≈ 240 ml</p>
                    <p>1 tbsp ≈ 15 ml</p>
                    <p>1 tsp ≈ 5 ml</p>
                </div>
            </section>
        </div>
    </main>
</div>
</body>
</html>
