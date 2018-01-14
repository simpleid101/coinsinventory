@extends('shared.master')
@extends('shared.nav')
@section('main')


<div class="row">
    <div class="col-sm-10">  
        <canvas id="c"></canvas>
    </div>
</div>

<div class="row" id="stats" name="stats">
    <div class="col-sm-4">
        <strong>Emperors</strong> 
        <ul id="emperors">

        </ul>
    </div>
    <div class="col-sm-4">
        <strong>Denominations</strong>
        <ul id="denominations">
        </ul>
    </div>
    <div class="col-sm-4">
        <strong>Dates</strong>
        <ul id="dates">
        </ul>
    </div>
</div>

@endsection



@extends('shared.footer')
@section('footer')
<script  src="/js/mo.js"> </script>
<script>

    var j =  {!! json_encode($map->toArray()) !!};
    var v = new MapView();
    v.init( {canvas: document.getElementById('c'), stats: document.getElementById('stats')} );
    var c = new MapController(v);
    c.redraw();
    c.registerDataRequestListener();

</script>
@endsection