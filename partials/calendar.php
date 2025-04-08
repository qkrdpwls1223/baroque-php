<div class="container-sm p-3 text-body-emphasis calendar" style="height: 90vh;">
  <div class="p-4 shadow rounded-4 bg-white border-0 mb-3">
    <div class="text-center d-flex flex-column gap-4">
    <?php
        $week = ['일', '월', '화', '수', '목', '금', '토'];
        $date->modify('first day of this month');
        $month = $date->format('n');

        echo "<div class='row text-primary'>";
        for ($i = 0; $i < 7; $i++) {
            echo "<div class='col'>{$week[$i]}</div>";
        }
        echo "</div>";
        $date->modify("-{$date->format('w')} days");

        for ($i = 0; $i < 6; $i++) {
            echo "<div class='row'>";
            for ($j = 0; $j < 7; $j++) {
                $formatted_date = $date->format('Y-m-d');
                $reserve_state = "";

                $sql = "SELECT count(*) FROM schedule WHERE date = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $formatted_date);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                $classies = "col";
                if ($month != $date->format('n')) {
                    $classies .= " other-month";
                }

                echo "<div class='{$classies}'>";

                $reserve_state = "d-none";
                $text_color = "text-white";

                if ($row = mysqli_fetch_array($result)) {
                    if ($row[0] >= 8) {
                        $reserve_state = "text-danger";
                    } elseif ($row[0] >= 4) {
                        $reserve_state = "text-warning";
                    } else {
                        $text_color = "text-dark";
                    }
                }

                echo "<div class='position-relative d-flex justify-content-center align-items-center'>";
                echo "<div class='position-absolute z-1 p-3 fs-1'>";
                echo "<i class='bi bi-circle-fill align-middle {$reserve_state}'></i>";
                echo "</div>";
                echo "<div class='position-absolute z-2 text-white'>";
                echo "<a class='d-block {$text_color} fs-6' href='booking?day={$date->format('Y-m-d')}'>{$date->format('j')}</a>";
                echo "</div>";
                echo "</div>";
                    
            
                echo "</div>";
                $date->modify("1 days");
            }
            echo "</div>";
        }
    ?>
    </div>
    <div class="container d-flex pt-4 gap-4">
    <div class="d-flex gap-1 align-items-center">
        <div class="circle bg-danger"></div>
        <span class="text-body-secondary">혼잡</span>
    </div>
    <div class="d-flex gap-1 align-items-center">
        <div class="circle bg-warning"></div>
        <span class="text-body-secondary">보통</span>
    </div>
</div>
</div>
<small class="text-body-secondary p-2">* 원하는 날짜를 클릭하면 예약 페이지로 이동합니다.</small>
</div>