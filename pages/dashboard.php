<?php


 include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>  
    <link rel="stylesheet" href="../assets/style.css">
    <?php
    require_once '../backend/db_connect.php';
    $collections = $client->selectCollection($dbname,'inventory');
    $eventCollections = $client->selectCollection($dbname,'events');
    $items = $collections->find();
    $events = $eventCollections->find([],['sort' => ['date' => -1], 'limit'=>3]);

    $notifCount = 0;
    $lowstockThreshold = 10;
    $instocks = 0;
    $lowstocks = 0;
    $outofstocks = 0;

    $totalItems = 0;
    $lowStocks = 0;
    $expiring = 0;
    $totalValue = 0;

    $itemsLowStock = [];
    $itemsOutofStock = [];

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
            $notifCount++;
            $lowstocks++;
            $itemsLowStock[] = $item;
        } else {
            $notifCount++;
            $outofstocks++;
            $itemsOutofStock[] = $item;
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
                    <button class="bell" id="bell_btn">🔔</button>
                    <span class="badge"><?php
                        if ($notifCount > 0){
                            echo htmlspecialchars($notifCount);
                        } else {
                            echo '';
                        }
                     ?></span>
                </div>
                <div id="notif-dialog">
                    <ul>
                        <?php foreach($itemsLowStock as $lowitems){
                                echo '<p><strong>' . htmlspecialchars($lowitems['name']) .'</strong> is low in stock</p>';
                                echo '<span class=\"alert-detail\">-- Only ' . htmlspecialchars($lowitems['stock']) . ' '. htmlspecialchars($lowitems['unit']) . ' remaining';

                            }
                            foreach($itemsOutofStock as $noitems){
                                echo "<p><strong>" . htmlspecialchars($noitems['name']) . "</strong> is out of stock</p>";
                                echo "<span class='alert-detail'>-- Restock immediately!</span>";
                            }    
                        ?>
                    </ul>
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
                    <h3>Upcoming Events</h3>
                    <ul class="activity-list">
                        <?php foreach($events as $event): ?>
                        <li><?php echo htmlspecialchars($event['name']) . ' - ' . htmlspecialchars($event['date']); ?></li>
                        <?php endforeach; ?>

                    </ul>
                </div>

                <div class="alerts-notifications">
                    <h3>⚠ Alerts & Notifications</h3>
                    <div class="alert-card">
                        <?php foreach($itemsLowStock as $lowitems){
                                echo '<p><strong>' . htmlspecialchars($lowitems['name']) .'</strong> is low in stock</p>';
                                echo '<span class=\"alert-detail\">Only ' . htmlspecialchars($lowitems['stock']) . ' '. htmlspecialchars($lowitems['unit']) . ' remaining';

                            }
                            foreach($itemsOutofStock as $noitems){
                                echo "<p><strong>" . htmlspecialchars($outItem['name']) . "</strong> is out of stock</p>";
                                echo "<span class='alert-detail'>Restock immediately!</span>";
                            }    
                        ?>
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
<script>
    let notif_btn = document.getElementById("bell_btn");
    let dialog = document.getElementById('notif-dialog');
    
    function toggleVisibility(){
        console.log('clicked');
        if (dialog.style.display == 'flex'){
            dialog.style.display = 'none';
        } else {
            dialog.style.display = 'flex'
        }
    }
    notif_btn.addEventListener('click', toggleVisibility);
</script>
</body>
</html>
