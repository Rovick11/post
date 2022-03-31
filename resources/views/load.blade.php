@extends('layouts.admin')

@section('content')
    <h1>Load</h1><br><br>
    <center>
        <label for=""><b>Customer's Name</b></label>
        <h3>{{$data['first_name']}} {{$data['last_name']}}</h3> <br><br>
        <form action="/load" method="get">
            @csrf
            <input type="hidden" name="id" value="{{$data['id']}}">
            <input type="hidden" name="balance" value="{{$data['balance']}}">
            <label for=""><b>Remaining Balance: </b>{{$data['balance']}}</label><br><br>
            <label for=""><b>Deposit:</b></label><br>
            <input type="text" name="bal"><br><br>
            <button type="submit" class="btn btn-primary">Load</button>
        </form>
    </center>
@endsection
