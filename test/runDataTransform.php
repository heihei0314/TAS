 <?php
   $athlete = "";
   if(isset($_GET['athlete'])){
    $athlete = $_GET['athlete'];
   }
   echo $athlete;
   include "../dataTransform.php";
   $dataTransform = new dataTransform();
   $dataTransform->transformData($athlete);
 ?>
     
