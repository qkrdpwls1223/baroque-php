<?php include __DIR__ . '/../config/config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prev = $_SERVER['HTTP_REFERER'] ?? '/';
    if (!isset($_POST['date']) || !isset($_POST['time']) || !isset($_POST['reserveName']) || !isset($_POST['userName'])) {
        header("Location: $prev");
        exit;
    }
    
    $date = $_POST['date'];
    $time = $_POST['time'];
    $reserveName = $_POST['reserveName'];
    $userName = $_POST['userName'];

    $sql = "SELECT count(*) FROM schedule WHERE date = ? AND time = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $date, $time);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_array($result)) {
        if ($row[0] == 0) {
            $sql = "INSERT INTO schedule (date, time, songName, userName) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $date, $time, $reserveName, $userName); // 두 개의 문자열
            mysqli_stmt_execute($stmt);
        }
    }
    
    header("Location: $prev");
    exit;
}
?>
