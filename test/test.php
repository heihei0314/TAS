<?php
   $athlete = "Lam Ching Ho";
    if(isset($_GET['athlete'])){
        $athlete = $_GET['athlete'];
    }
        include "component/data-analyser/analyser.php";
        $analyser = new Profile();
        $profile = $analyser->calculateMean($athlete);
        print_r($profile);
 ?>