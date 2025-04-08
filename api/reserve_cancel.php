<?php include 'config/config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prev = $_SERVER['HTTP_REFERER'] ?? '/';
    if (!isset($_POST['date']) || !isset($_POST['time'])) {
        header("Location: $prev");
        exit;
    }
    

    $date = $_POST['date'];
    $time = $_POST['time'];

    $sql = "DELETE FROM schedule WHERE date = ? AND startTime = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();

    header("Location: $prev");
    exit;
}
?>