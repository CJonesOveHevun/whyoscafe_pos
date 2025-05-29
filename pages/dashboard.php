<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>  
    <link rel="stylesheet" href="../assets/style.css">
    <main>
        <div class="dashboard">
            <?php date_default_timezone_set('Asia/Manila'); ?>
            <div class="topbar">
            <h2 class="dash">Dashboard</h2>
            <p class="dashboard-subtitle">Inventory forecasting and management overview</p>
                <div class="notifications">
                    <span class="bell">🔔</span>
                    <span class="badge">3</span>
                </div>
                <div class="datetime">
                    <span class="date"><?php echo date('F j, Y'); ?></span>
                    <span class="time"><?php echo date('h:i A'); ?></span>
                </div>
            </div>

            <div class="dashboard-cards">
                <div class="card total-items">
                    <p>Total Items</p>
                    <h1>8</h1>
                    <p class="info">↗ +12% from last week</p>
                </div>
                <div class="card low-stock">
                    <p>Low Stock Items</p>
                    <h1>1</h1>
                    <p class="warning">⚠️ Needs attention</p>
                </div>
                <div class="card expiring">
                    <p>Expiring Soon</p>
                    <h1>0</h1>
                    <p class="info-yellow">🕒 Within 7 days</p>
                </div>
                <div class="card total-value">
                    <p>Total Value</p>
                    <h1>₱19,981</h1>
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
<script src="../pages/dashboard.js"></script>
</body>
</html>
