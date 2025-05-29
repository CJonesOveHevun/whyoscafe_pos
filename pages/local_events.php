<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
    <main>
        <div class="dashboard">
            <?php date_default_timezone_set('Asia/Manila'); ?>
            <div class="topbar">
                <h2 class="dash">Local Events</h2>
                <p class="dashboard-subtitle">Upcoming Philippine holidays and regional events</p>
                <div class="datetime">
                    <span class="date"><?php echo date('F j, Y'); ?></span>
                    <span class="time"><?php echo date('h:i A'); ?></span>
                </div>
            </div>

            <div class="events-container">
                <div class="event-card">
                    <h3>Independence Day</h3>
                    <p class="event-date">June 12, 2025</p>
                    <p class="event-description">A national holiday commemorating Philippine independence from Spanish rule.</p>
                </div>

                <div class="event-card">
                    <h3>Kadayawan Festival</h3>
                    <p class="event-date">August 2025</p>
                    <p class="event-description">A celebration of life, thanksgiving for nature's gifts, and cultural heritage in Davao City.</p>
                </div>

                <div class="event-card">
                    <h3>Buwan ng Wika</h3>
                    <p class="event-date">August 1-31, 2025</p>
                    <p class="event-description">A month-long celebration highlighting Filipino language and culture in schools nationwide.</p>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
