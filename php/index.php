<!DOCTYPE html>
<html>
<head>
    <title>Remote Admin Panel</title>
</head>
<body>
    <h1>Send Command to Device</h1>
    <form method="post" action="send_fcm.php">
        <input type="text" name="topic" placeholder="Device Topic (e.g., device001)" required><br>
        <input type="text" name="title" placeholder="Notification Title" required><br>
        <input type="text" name="body" placeholder="Notification Body" required><br>
        <button type="submit">Send Push</button>
    </form>
    <h1>Update Device Status</h1>
    <form method="post" action="update_status.php">
        <input type="text" name="device_id" placeholder="Device ID (e.g., device001)" required><br>
        <input type="text" name="status" placeholder="New Status" required><br>
        <button type="submit">Update Status</button>
    </form>
    <h1>Log Action</h1>
    <form method="post" action="log_action.php">
        <input type="text" name="device_id" placeholder="Device ID" required><br>
        <input type="text" name="action" placeholder="Action" required><br>
        <button type="submit">Log</button>
    </form>
</body>
</html>