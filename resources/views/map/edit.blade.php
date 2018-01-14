@extends('shared.master')
@extends('shared.nav')
@section('main')

<div class="row">
    <div class="col-sm-12">  
        <canvas id="c"></canvas>
    </div>

    <div class="col-sm-12">
        <form method="post" action="{{action('MapController@update')}}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @include('shared.errors')
            {{ csrf_field() }}

            <label for="grid-size">Grid Size</label>
            <input type="number" id="grid-size" name="grid-size" >
            <br>

            <label for="mapImg">Map Image</label>
            <input type="file" id="mapImg" name="mapImg">
        <br>
            <input type="submit">
        </form>
    </div>
</div>
@endsection

@extends('shared.footer')
@section('footer')
<script  src="/js/mo.js"> </script>
<script>

    var j =  {!! json_encode($map->toArray()) !!};
    var v = new MapViewEN(    
    {
            canvas: document.getElementById('c'),
            inputGridSize: document.getElementById('grid-size'),
            inputImage: document.getElementById('mapImg')
        });
    var c = new MapController(v);
    c.registerInputListeners();
    c.redraw();
// function MapObject(){
//     this.input = document.getElementById('mapImg');
//     this.canvas = document.getElementById('c');
//     this.ctx = this.canvas.getContext('2d');
//     this.grid_size = document.getElementById('grid-size');
//     this.img;
// }

// MapObject.prototype.handleFiles = function(e){
//     if (e.target || e.map_image)
//         var img = new Image;
//         this.img = img;
//         if (e.map_image) {    
//             img.src = e.map_image.replace('public', '/storage');
//         } else if (e.target.files[0]){
//             img.src = URL.createObjectURL(e.target.files[0]);
//         }
//             img.onload = function() {
//                 this.drawGrid(j);
//                 this.grid_size.removeAttribute('disabled');
//             }.bind(this)
//     }


// MapObject.prototype.drawGrid = function(e){
//     this.clearCanvas();
//     this.drawImg();
    
//     var height =  this.canvas.getAttribute('height');
//     var width =  this.canvas.getAttribute('width');
//     var gSize = e.target ? parseInt(e.target.value) : j.grid_size;


//     for(var x = gSize; x < width; x += gSize){
//         this.ctx.beginPath();
//         this.ctx.moveTo(x, 0);
//         this.ctx.lineTo(x, height);
//         this.ctx.stroke();
//     }

//     for(var y = gSize; y < height; y += gSize){
//         this.ctx.beginPath();
//         this.ctx.moveTo(0, y);
//         this.ctx.lineTo(width, y);
//         this.ctx.stroke();
//     }
// }

// MapObject.prototype.drawImg = function(){
//     $(this.canvas).attr('width', this.img.width);
//     $(this.canvas).attr('height', this.img.height);
//     this.ctx.drawImage(this.img,0,0, this.img.width,this.img.height);
// }

// MapObject.prototype.init = function(){
//     this.input.addEventListener('change', this..bind(this));
//     this.grid_size.addEventListener('change', this.drawGrid.bind(this));
//     if(j.grid_size){
//         this.grid_size.value = j.grid_size;
//     }
//     this.handleFiles(j);

// }

// MapObject.prototype.clearCanvas = function(){
//     this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
// }

// var mo = new MapObject();
// mo.init();

</script>

@endsection