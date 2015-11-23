<!DOCTYPE html>
<html lang="pl">
  <head>
   <meta charset="UTF-8">
   <title><?php echo Lang::$lang[0]; ?></title>
   <meta name="description" content="<?php echo Lang::$lang[1]; ?>">
   <link rel="stylesheet" href="template/style.css">
  </head>
  <body>
   <h1><?php echo Lang::$lang[2]; ?></h1>
   
   <nav>
    <h2><?php echo lang::$lang[3]; ?></h2>
    <ul>
	 <?php
	 foreach(lang::$lang[4] as $key => $value)
	 {
	   echo '<li><a href="'.$key.'" title="'.$value.'">'.$value.'</a></li>';
	 }
	 ?>
	</ul>
   </nav>
   
   <?php echo isset($result) ? '<p>'.$result.'</p>' : null; ?>
   <p><?php echo lang::$lang[5]; ?></p>
   
   <ul class="lang">
    <li><a href="index.php?lang=pl" title="Polski"><?php echo lang::$lang[6]; ?></a></li>
    <li><a href="index.php?lang=en" title="Angielski"><?php echo lang::$lang[7]; ?></a></li>
   </ul>
   
  </body>
</html>