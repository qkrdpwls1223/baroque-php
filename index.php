<?php include 'header.php'; ?>

<?php
$now = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$date = DateTime::createFromFormat('Y-m', $now);

$prevMonth = (clone $date)->modify('-1 month')->format('Y-m');
$nextMonth = (clone $date)->modify('+1 month')->format('Y-m');
?>

<!-- 년도 및 달 이동 버튼 컨테이너 -->
<div class="container text-center p-3">
  <div class="row align-items-center">
    <div class="col">
    <a href="?month=<?= $prevMonth ?>" class="btn btn-primary"><i class="bi bi-chevron-left"></i></a>
    </div>
    <div class="col">
    <h2><?php echo $date->format('Y.n'); ?></h2>
    </div>
    <div class="col">
    <a href="?month=<?= $nextMonth ?>" class="btn btn-primary"><i class="bi bi-chevron-right"></i></a>
    </div>
  </div>
</div>
<?php include 'calendar.php'; ?>
<?php include 'footer.php'; ?>