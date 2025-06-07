<?php include '../header.php'; ?>
<div class="container">
    <?php include '../sidebar.php'; ?>
    <link rel="stylesheet" href="../assets/style.css">
    <?php
    require_once '../backend/db_connect.php';
    $eventCollections = $client->selectCollection($dbname, 'events');
    $events = $eventCollections->find();
    ?>
    <main>
        <div class="topbar">
                <div>
                    <h2>Local Events - Philippines</h2>
                    <p class="dashboard-subtitle">Upcoming Philippine holidays and regional events</p>
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
</body>
</html>
