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
            Win Rate: <span id='WinRate1'></span><br>
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
            Win Rate: <span id='WinRate2'></span><br>
        </p></div>
        <button>Compare</button>
    </body>
    <script>
    
    function getProfile(athlete,i){
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            const profile = JSON.parse(this.responseText);
            console.log(profile);
            
            document.getElementById('win'+i).innerHTML = profile.win;
            document.getElementById('lose'+i).innerHTML = profile.lose;
            document.getElementById('WinningRound'+i).innerHTML = profile.WinningRound;
            document.getElementById('Score'+i).innerHTML = profile.Score;
            document.getElementById('Punch'+i).innerHTML = profile.Punch;
            document.getElementById('Body'+i).innerHTML = profile.Body;
            document.getElementById('Head'+i).innerHTML = profile.Head;
            document.getElementById('SpinBody'+i).innerHTML = profile.SpinBody;
            document.getElementById('SpinHead'+i).innerHTML = profile.SpinHead;
            document.getElementById('Warning'+i).innerHTML =profile.Warning;
        }
        xmlhttp.open("POST", "resource/getMean.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("athlete=" + athlete);
    }

    </script>
</html>
