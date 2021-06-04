<?php 
$file = fopen("cmpt/cmpt.txt", 'r+');
$count = fgets($file);
fseek($file,0);
$count++;
fputs($file, $count);
fclose($file);
echo '<p> nombre de visite <strong> '. ' '.$count.' '.' </strong> fois </p>'
?>