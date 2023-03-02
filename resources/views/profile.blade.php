@extends('layout.app')

@section('athletes')
    @foreach ($athletes as $athlete)
        <option value='{{$athlete}}'>{{$athlete}}</option>
    @endforeach
@endsection

@section('profile1')
     <p>
        
            Name:  <span id='name1'> </span><br>
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
        </p>
@endsection

@section('profile2')
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
        </p>
@endsection

@section('effect')
    
        Punch: {{$effect['punch']}}<br>
        Body: {{$effect['body']}}<br>
        Head: {{$effect['head']}}<br>
        Spinning Kick on Body: {{$effect['spinBody']}}<br>
        Spinning Kick on Head: {{$effect['spinHead']}}<br>
        Warning: {{$effect['warning']}}<br>
    
@endsection

