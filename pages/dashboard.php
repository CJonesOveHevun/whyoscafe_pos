<?php


 include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>  
    <link rel="stylesheet" href="../assets/style.css">
    <?php
    require_once '../backend/db_connect.php';
    $collections = $client->selectCollection($dbname,'inventory');
    $items = $collections->find();

    $lowstockThreshold = 10;
    $instocks = 0;
    $lowstocks = 0;
    $outofstocks = 0;

    $totalItems = 0;
    $lowStocks = 0;
    $expiring = 0;
    $totalValue = 0;

    $today = new DateTime();
    $today->setTime(0, 0);
    $inSevenDays = (clone $today)->modify('+7 days');
    foreach ($items as $item){
        $totalItems++;
        if(isset($item['stock'])&&$item['stock'] < $lowstockThreshold) {
            $lowStocks++;
        }
        if (!empty($item['expiry_date'])){
            try{
                $expiry=new DateTime($item['expiry_date']);
                if($expiry >=$today && $expiry <=$inSevenDays){
                    $expiring++;
                }
            }catch(Exception $err){
                echo $err;
            }
        }
        if (isset($item['stock'], $item['price'])){
            $totalValue += $item['price'];
        }
        $stock = isset($item['stock']) ? (int)$item['stock'] : 0;
        if ($stock > $lowstockThreshold) {
            $instocks++;
        } elseif ($stock > 0 && $stock <= $lowstockThreshold) {
            $lowstocks++;
        } else {
            $outofstocks++;
        }
    }
    $inventoryStatus = [$instocks, $lowstocks,$outofstocks];
    ?>
    <main>
        <?php date_default_timezone_set('Asia/Manila'); ?>
            <div class="topbar">
                <div>
                    <h2>Dashboard</h2>
                    <p class="dashboard-subtitle">Inventory forecasting and management overview</p>
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
        <div class="dashboard">
            

            <div class="dashboard-cards">
                <div class="card total-items">
                    <p>Total Items</p>
                    <h1><?=$totalItems?></h1>
                    <p class="info">↗ +12% from last week</p>
                </div>
                <div class="card low-stock">
                    <p>Low Stock Items</p>
                    <h1><?=$lowStocks?></h1>
                    <p class="warning">⚠️ Needs attention</p>
                </div>
                <div class="card expiring">
                    <p>Expiring Soon</p>
                    <h1><?=$expiring?></h1>
                    <p class="info-yellow">🕒 Within 7 days</p>
                </div>
                <div class="card total-value">
                    <p>Total Value</p>
                    <h1>₱<?= number_format($totalValue, 2)?></h1>
                    <p class="calendar-info">📅 Current inventory</p>
                </div>
            </div>
            
            <div class="dashboard-charts">
                <div class="chart-section">
                    <h3 class="chart-title">Demand Forecast</h3>
                    <canvas id="demandChart" height="200"></canvas>
                </div>
                    <div class="chart-section">
                        <h3 class="chart-title">Inventory Levels</h3>
                        <canvas id="inventoryChart" height="200"></canvas>
                    </div>
            </div>

            <!-- Recent Activities and Alerts -->
            <div class="bottom-section">
                <div class="recent-activities">
                    <h3>Recent Activities</h3>
                    <ul class="activity-list">
                        <li>Added 20 bottles of Vanilla Syrup to inventory</li>
                        <li>Removed 5 expired Milk packs</li>
                        <li>Updated stock value for Chocolate Powder</li>
                    </ul>
                </div>

                <div class="alerts-notifications">
                    <h3>⚠ Alerts & Notifications</h3>
                    <div class="alert-card">
                        <p>⚠ <strong>Caramel Syrup</strong> is low in stock</p>
                        <span class="alert-detail">Only 2.100 L remaining</span>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.inventoryData ={
        stockLevels: <?=json_encode($inventoryStatus)?>
    }
</script>
<script src="../pages/dashboard.js"></script>
</body>
</html>
