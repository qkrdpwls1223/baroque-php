<div class="container-sm p-3 text-body-emphasis">
  <div class="p-4 shadow-sm rounded-4 bg-white border-0">
    <div class="text-center d-flex flex-column gap-4">
    <?php
        $week = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
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
                if ($month != $date->format('n'))
                    echo "<div class='col other-month'>{$date->format('j')}</div>";
                else
                    echo "<div class='col'>{$date->format('j')}</div>";
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
</div>