<?php include 'config/config.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= SITE_NAME ?></title>
    
    <!-- 부트스트랩 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/cosmo/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <style>
      .calendar .row {
        margin-top: 0.3rem !important; /* mt-3와 동일한 효과 */
        margin-bottom: 1.5rem !important;
      }
      .calendar i {
        opacity: 0.7;
      }
      .col {
        min-width: 0;
        max-width: 100%;
      }
      .other-month {
        opacity: 0.5;
      }
      .circle {
        width: 12px;
        height: 12px;
        border-radius: 50%;
      }
      a {
        text-decoration: none;
      }
    </style>
</head>