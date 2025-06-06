<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/inventory.css">
    <?php
    require_once '../backend/db_connect.php';
    $collections = $client->selectCollection($dbname,'inventory');
    $items = $collections->find();
    ?>
    <main>
        <div class="topbar">
            <div>
                <h2>Inventory Management</h2>
                <p class="dashboard-subtitle">Manage your cafe's inventory</p>
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

        <div class="main-content">
            <h1>Inventory Management</h1>
            <button onclick="openDialog()">+ Add Item</button>

            <table>
            <thead>
                <tr>
                <th>Item</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Unit</th>
                <th>Expiry Date</th>
                <th>Status</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody id="inventory-list">
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name'])?></td>
                    <td><?php echo htmlspecialchars($item['category'])?></td>
                    <td><?php echo (int)$item['stock']?></td>
                    <td><?php echo htmlspecialchars($item['unit'])?></td>
                    <td><?php echo htmlspecialchars($item['expiry_date'])?></td>
                    <td>
                        <?php
                        $stock = (int)$item['stock'];
                        echo $stock > 10 ? "In Stock" : ($stock > 0 ? "Low Stock" : "Out of Stock");
                        ?>
                    </td>
                    
                    <td>
                        <button>Edit</button>
                        <form method="POST" action="delete_item.php" onsubmit="return confirm('Are you sure you want to remove this item?')">
                        <input type="hidden" name="id" value="<?=$item["_id"]?>">
                        <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>

        <!-- Modal Dialog -->
        <div id="itemdialog" class="dialog">
            <div class="item-content">
                <span onclick="closeDialog()" class="close">&times;</span>
                <h2>Add New Item</h2>
                <form action="add_item.php" method="POST">
                    <label>Item Name:</label>
                    <input type="text" name="name" required>

                    <label>Category:</label>
                    <select id="category" name="category">
                        <option value="">--Select Category---</option>
                        <option value="Coffee Beans">Coffee Beans</option>
                        <option value="Dairy Products">Dairy Products</option>
                        <option value="Pastries">Pastries</option>
                        <option value="Syrups">Syrups</option>
                        <option value="Supplies">Supplies</option>
                        <option value="Sweeteners">Sweeteners</option>
                    </select>
                    <div>
                        <label>Stock:</label>
                        <input type="number" min="0" name="stock" required>

                        <label>Unit:</label>
                        <select id="unit" name="unit">
                        <option value="g">Grams</option>
                        <option value="kg">Kilograms</option>
                        <option value="mg">Milligrams</option>
                        <option value="L">Liters</option>
                        <option value="mL">Milliliters</option>
                        <option value="pieces">Pieces</option>
                    </select>
                    </div>
                    <label>Price:</label>
                    <input type="number" name="price" step="0.01" min="0" required>

                    <label>Expiry Date:</label>
                    <input type="date" name="expiry_date">

                    <button type="submit">Add Item</button>
                </form>
            </div>
        </div>
        


    </main>
</div>
<script>
    function openDialog(){
        document.getElementById("itemdialog").style.display = "block";
    }
    function closeDialog(){
        document.getElementById("itemdialog").style.display = "none";
    }
</script>
</body>
</html>