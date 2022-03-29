<center>
@foreach ($data as $data)
<b>CPUniversity</b><br>
<b>OrangeApps Property</b><br>
<b>Alrights reserved 2022</b><br><br>
<label for="">Date of Purchase: </label><b>{{$data['created_at']}}</b><br>
@endforeach

@foreach ($data as $data)
<label for="">Price: </label><b>{{$data['price']}}</b>
@endforeach

<br><br><br><br><br><br><br>
<button onclick="window.print()" class="btn btn-app">Print Reciept</button>
</center>
