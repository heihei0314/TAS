 <? php
   $athlete = "";
    if(isset($_GET['athlete'])){
        $athlete = $_GET['athlete'];
    }
        include "../analyser.php";
        $analyser = new Profile();
        $profile = $analyser->calculateMean($athlete);
        print_r($profile);
 ?>
 
