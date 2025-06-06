<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/inventory.css">
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
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Unit</th>
                <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody id="inventory-list">
                <!-- Inventory items will be inserted here from MongoDB -->
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
                    <input type="text" name="category" required>
                    <div>
                        <label>Stock:</label>
                        <input type="number" name="stock" required>

                        <label>Unit:</label>
                        <input type="text" name="unit" required>
                    </div>
                    

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