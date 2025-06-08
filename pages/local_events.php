<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
    <?php
    require_once '../backend/db_connect.php';
    $eventCollections = $client->selectCollection($dbname, 'events');
    $collections = $client->selectCollection($dbname, 'inventory');
    $items = $collections->find();
    $events = $eventCollections->find();
    $lowstockItems = [];
    $nostockItems = [];
    $notifCount = 0;
    foreach ($items as $item){
        if ($item['stock'] > 0 && $item['stock'] < 10) {
            $lowstockItems[] = $item;
            $notifCount++;
        } elseif  ($item['stock'] == 0) {
            $nostockItems[] = $item;
            $notifCount++;
        }
    }
    ?>
    <main>
        <?php date_default_timezone_set('Asia/Manila'); ?>
        <div class="topbar">
                <div>
                    <h2>Local Events - Philippines</h2>
                    <p class="dashboard-subtitle">Upcoming Philippine holidays and regional events</p>
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
                            <?php foreach($lowstockItems as $lowitems){
                                    echo '<p><strong>' . htmlspecialchars($lowitems['name']) .'</strong> is low in stock</p>';
                                    echo '<span class=\"alert-detail\">-- Only ' . htmlspecialchars($lowitems['stock']) . ' '. htmlspecialchars($lowitems['unit']) . ' remaining';

                                }
                                foreach($nostockItems as $noitems){
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
            <?php date_default_timezone_set('Asia/Manila'); ?>
            
            <div class="events-container">
                <div class="event-actions">
                    <h2>Local Events</h2>
                    <div>
                        <label for="events"></label>
                        <select id="events" class="input-generic">
                            <option value="all">All...</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                        <button type="button" id="add_event_btn">+ Add event</button>
                    </div>
                </div>
                
            </div>
            <div class="events-container">
                <?php foreach($events as $event):?>
                <div class="event-card">
                    <h3><?php echo htmlspecialchars($event['name'])?></h3>
                    <p class="event-date"><?php echo htmlspecialchars($event['date'])?></p>
                    <p class="event-description"><?php echo htmlspecialchars($event['description'])?></p>
                </div>
                <?php endforeach;?>

            </div>
        </div>
    </main>
    <div id="event-dialog" class="dialog">
        <div class="modal-content">
            <div>
                <h2>Add New Event</h2>
                <span class="close_dialog" onclick="closeDialog()">&times;</span>
            </div>
            
            
            <form action="add_event.php" method="POST">
                <label for="event_name">Event Name:</label>
                <input type="text" id="event_name" name="event_name" required class="input-generic">

                <label for="event_date">Event Date:</label>
                <input type="date" id="event_date" name="event_date" required class="input-generic">

                <label for="event_description">Description:</label>
                <textarea id="event_description" name="event_description" rows="4" required class="input-generic event-desc"></textarea>

                <div class="modal-actions">
                    <button type="submit" class="btn-confirm">Save Event</button>
                    <button type="button" class="btn-cancel" onclick="closeDialog()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    
    function openDialog(){
        document.getElementById("event-dialog").style.display = "block";
    }
    function closeDialog(){
        document.getElementById("event-dialog").style.display = "none";
    }
    document.getElementById("add_event_btn").addEventListener("click", openDialog);
</script>
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
