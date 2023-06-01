<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?=$page_title?></title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <?php
      if ($page_style == 'admin') {
         echo '<link rel="stylesheet" href="css/admin_style.css">';
      }
      if ($page_style == 'user') {
         echo '<link rel="stylesheet" href="css/style.css">';
      }
   ?>

</head>
<body>