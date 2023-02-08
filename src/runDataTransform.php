 <?php
   $athlete = "Lam Ching Ho";
   if(isset($_GET['athlete'])){
    $athlete = $_GET['athlete'];
   }
   echo $athlete;
   include "../component/data-collection/dataTransform.php";
   $dataTransform = new dataTransform();
   $dataTransform->transformData($athlete);
 ?>
     
