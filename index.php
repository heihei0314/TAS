<?php
    include 'resource/controller.php';
    $controller = new Controller();
    //get all athletes' name for option select
    $allAthletes = $controller->getAthletes();
?>

<html>
    <header>
        <title>Taekwondo Analysis System</title>
        <style>
            .profile {
                float:left;
                padding-right:2em;
            }
        </style>
    </header>
    <body>
        <h1>Taekwondo Analysis System</h1>
        
        <div id='profile1' class='profile'>
        <label for="athlete1">Choose an athlete:</label>
        <select id="athlete1" onchange="getProfile(this.value,1)">
        <option></option>
        <?php 
            //print form
            foreach ($allAthletes as $name){
               echo '<option value="'.$name.'">'.$name.'</option>';
            }    
            //print form
        ?>
        </select>
        <p>
            Name:  <span id='name1'></span><br>
            Number of Games Won: <span id='win1'></span><br>
            Number of Games Lose: <span id='lose1'></span><br>
            Average Winning Rounds: <span id='WinningRound1'></span><br>
            Average Scores: <span id='Score1'></span><br>
            Average Punch: <span id='Punch1'></span><br>
            Average Kick on Body: <span id='Body1'></span><br>
            Average Kick on Head: <span id='Head1'></span><br>
            Average Spinning Kick on Body: <span id='SpinBody1'></span><br>
            Average Spinning Kick on Head: <span id='SpinHead1'></span><br>
            Average Warning: <span id='Warning1'></span><br>
            Predicted Win Rate: <span id='WinRate1'></span><br>
        </p></div>
        <div id='profile2' class='profile'>
        <label for="athlete2">Choose an athlete:</label>
        <select id="athlete2" onchange="getProfile(this.value,2)">
        <option></option>
        <?php 
            //print form
            foreach ($allAthletes as $name){
               echo '<option value="'.$name.'">'.$name.'</option>';
            }    
            //print form
        ?>
        </select>
        <p>
            Name:  <span id='name2'></span><br>
            Number of Games Won: <span id='win2'></span><br>
            Number of Games Lose: <span id='lose2'></span><br>
            Average Winning Rounds: <span id='WinningRound2'></span><br>
            Average Scores: <span id='Score2'></span><br>
            Average Punch: <span id='Punch2'></span><br>
            Average Kick on Body: <span id='Body2'></span><br>
            Average Kick on Head: <span id='Head2'></span><br>
            Average Spinning Kick on Body: <span id='SpinBody2'></span><br>
            Average Spinning Kick on Head: <span id='SpinHead2'></span><br>
            Average Warning: <span id='Warning2'></span><br>
            Predicted Win Rate: <span id='WinRate2'></span><br>
        </p></div>
    </body>
    <script>
    

    function getProfile(athlete,i){
        //activate get game data for event message
            //event message
        
        //activate get game data for event message
        const xmlhttp = new XMLHttpRequest();
        var profile;
        xmlhttp.onload = function() {
            profile = JSON.parse(this.responseText);
            console.log(profile);
            
            document.getElementById('win'+i).innerHTML = Math.round(profile.win*100)/100;
            document.getElementById('lose'+i).innerHTML = Math.round(profile.lose*100)/100;
            document.getElementById('WinningRound'+i).innerHTML = Math.round(profile.WinningRound*100)/100;
            document.getElementById('Score'+i).innerHTML = Math.round(profile.Score*100)/100;
            document.getElementById('Punch'+i).innerHTML = Math.round(profile.Punch*100)/100;
            document.getElementById('Body'+i).innerHTML = Math.round(profile.Body*100)/100;
            document.getElementById('Head'+i).innerHTML = Math.round(profile.Head*100)/100;
            document.getElementById('SpinBody'+i).innerHTML = Math.round(profile.SpinBody*100)/100;
            document.getElementById('SpinHead'+i).innerHTML = Math.round(profile.SpinHead*100)/100;
            document.getElementById('Warning'+i).innerHTML =Math.round(profile.Warning*100)/100;
            document.getElementById('name'+i).innerHTML =athlete;
            getWinRate();
        }
        xmlhttp.open("POST", "resource/getMean.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("athlete=" + athlete);
        
    }
    
    function getWinRate(){
        var athlete1 = document.getElementById('name1').innerHTML;
        var athlete2 = document.getElementById('name2').innerHTML;
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            const winRate = JSON.parse(this.responseText);
            console.log(winRate);
            document.getElementById('WinRate1').innerHTML = winRate[0];
            document.getElementById('WinRate2').innerHTML = winRate[1];
        }
        xmlhttp.open("POST", "resource/getWinRate.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("athlete1=" + athlete1+"&athlete2=" + athlete2);
    }

    </script>
</html>