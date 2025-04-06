<?php include '../includes/header.php'; ?>
<?php
$now = isset($_GET['day']) ? $_GET['day'] : date('Y-m-d');
$date = DateTime::createFromFormat('Y-m-d', $now);
$formatted_date = $date->format('Y-m-d');

$sql = "SELECT * FROM schedule WHERE date = ? ORDER BY startTime ASC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $formatted_date);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$hourlySlots = array_fill(0, 24, []);

while ($row = mysqli_fetch_assoc($result)) {
    $hour = (int)date('G', strtotime($row['startTime']));
    $hourlySlots[$hour] = $row;
}

$prevWeek = (clone $date)->modify('-7 days')->format('Y-m-d');
$nextWeek = (clone $date)->modify('7 days')->format('Y-m-d');
?>
<style>
    .clear {
        border-color: transparent !important;
    }
    .square {
        aspect-ratio: 1 / 1;
    }
    .bi-chevron-left, .bi-chevron-right {
        font-size: 1.5rem;
        font-weight: bold;
        text-shadow: 0 0 1px black;"
    }

</style>
<div class="container" style="max-width: 600px;">
    <div class="container text-center rounded shadow-sm p-3 mb-5">
        <div class="row align-items-center mb-5">
            <div class="col">
            <a href="?day=<?= $prevWeek ?>" class="btn btn-outline-primary border-0 day-move" data-date="<?= $prevWeek ?>"><i class="bi bi-chevron-left"></i></a>
            </div>
            <div class="col-6">
            <h2><?php echo $date->format('Y.n'); ?></h2>
            </div>
            <div class="col">
            <a href="?day=<?= $nextWeek ?>" class="btn btn-outline-primary border-0 day-move" data-date="<?= $nextWeek ?>"><i class="bi bi-chevron-right"></i></a>
            </div>
        </div>
        <div class="row">
            <?php
            $week = ['일', '월', '화', '수', '목', '금', '토'];
            $d = clone $date;
            $d->modify("-3 days");
            for ($i=0; $i < 7; $i++) {
                // 기본 클래스 구성
                $colClasses = "col d-flex flex-column align-items-center gap-3";
                $btnClasses = "btn rounded-circle font-monospace square";

                // 색상 추가
                if ($i == 0 || $i == 6) {
                    $colClasses .= " text-body-tertiary";
                    $btnClasses .= " text-body-tertiary";
                } elseif ($i == 1 || $i == 5) {
                    $colClasses .= " text-body-secondary";
                    $btnClasses .= " text-body-secondary";
                } elseif ($i == 3) {
                    $colClasses .= " text-dark";
                    $btnClasses .= " btn-primary";
                } else {
                    $colClasses .= " text-dark";
                    $btnClasses .= " text-dark";
                }

                echo "<div class='{$colClasses}'>";
                echo "<span>{$week[$d->format('w')]}</span>";

                echo "<a href='?day={$d->format('Y-m-d')}' class='{$btnClasses} day-move' data-date='{$d->format('Y-m-d')}'>{$d->format('j')}</a>";
                echo "</div>";
                $d->modify("1 days");
            }
            ?>
        </div>
    </div>
    <?php $week_kor = $week[$d->format('w')]; ?>
    <h3 class="mb-4"><?= $date->format('m월 j일') . " ({$week_kor})" ?></h3>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                function getColorClass($text) {
                    $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                    $hash = crc32($text); // 문자열 → 숫자 해시
                    $index = $hash % count($colors); // 배열 크기 기준으로 나눔
                    return $colors[$index];
                }
                
                for ($i=0; $i < 24; $i++) { 
                    $formatted = str_pad($i, 2, '0', STR_PAD_LEFT) . ":00";
                    
                    echo "<div class='row mb-2'>";
                    echo "<div class='col-3 p-2'>{$formatted}</div>";

                    if ($hourlySlots[$i] == null) {
                        echo "<div class='btn btn-light col p-3 text-center time-slot shadow-sm'";
                        echo "data-bs-toggle='modal' data-bs-target='#reserveModal'";
                        echo "data-time='{$formatted}'>";
                        echo "예약 가능";
                    } else {
                        $randomColor = getColorClass($hourlySlots[$i]['songName']);
                        echo "<div class='btn btn-{$randomColor} disabled col p-3 text-center shadow-sm'";
                        echo "data-time='{$formatted}'>";
                        echo $hourlySlots[$i]['songName'] . " ({$hourlySlots[$i]['userName']})";
                    }
                    
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.day-move').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault(); // 기본 링크 이동 막기

            const selectedDate = el.dataset.date;
            history.replaceState(null, "", `/booking.php?day=${selectedDate}`);

            location.reload();
        });
    });

</script>
<?php include '../views/booking_modal.php'; ?>

<?php include '../includes/footer.php'; ?>