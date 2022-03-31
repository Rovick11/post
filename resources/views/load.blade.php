<h1>Load</h1>
<form action="/load" method="get">
    @csrf
    <input type="hidden" name="id" value="{{$data['id']}}">
    <input type="hidden" name="balance">
    <label for=""><b>Deposit:</b></label><br>
    <input type="text" name="bal">
    <button type="submit">Load</button>
</form>
