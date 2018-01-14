

function MapView(){
    this.canvas;
    this.ctx;
    this.stats

}

MapView.prototype.init = function(c){
    this.canvas = c.canvas;
    this.ctx = this.canvas.getContext('2d');
    this.stats = c.stats;

}
// Getters&Setters
MapView.prototype.getCanvas = function(){
    return this.canvas;
}


MapView.prototype.setCanvas = function(){}

MapView.prototype.getCtx = function(){
    return this.ctx;
}

//REQUIRES: context, canvas
//MODIFIES: context
//EFFECTS: clears the canvas
MapView.prototype.clearCanvas = function(){
    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
}

//REQUIRES: canvas, image blob/url
//MODIFIES: context
//EFFECTS: draw an image on canvas 
MapView.prototype.drawImage = function(i){
    $(this.canvas).attr('width', i.width);
    $(this.canvas).attr('height', i.height);
    this.ctx.drawImage(i,0,0, i.width, i.height);
}

//REQUIRES: canvas, gridSize
//MODIFIES: context
//EFFECTS: draw a grid over the canvas
MapView.prototype.drawGrid = function(gs){
    var height =  this.canvas.getAttribute('height');
    var width =  this.canvas.getAttribute('width');
    
    for(var x = gs; x < width; x += gs){
        this.ctx.beginPath();
        this.ctx.moveTo(x, 0);
        this.ctx.lineTo(x, height);
        this.ctx.stroke();
    }

    for(var y = gs; y < height; y += gs){
        this.ctx.beginPath();
        this.ctx.moveTo(0, y);
        this.ctx.lineTo(width, y);
        this.ctx.stroke();
    }
}

//MODIFIES: context
//EFFECTS: clear canvas, draw image and grid
MapView.prototype.redraw = function(i,gs){
    this.clearCanvas();
    this.drawImage(i);
    this.drawGrid(gs);
}

MapView.prototype.renderSquareData = function(data){
    for(stat in data){
        $('#' + stat).html('');
        for(i in data[stat]){
            $('#' + stat).append("<li><strong>"+data[stat][i].label+"</strong>: "+data[stat][i].count+"</li>");
        }
    }
}
function MapViewEN(de){
    this.canvas = de.canvas;
    this.ctx = this.canvas.getContext('2d');
    this.inputGridSize = de.inputGridSize;
    this.inputImage = de.inputImage;
}

MapViewEN.prototype = new MapView();
Object.defineProperty(MapViewEN.prototype, 'constructor', {enumerable: false, value: MapViewEN, writable: true});

MapViewEN.prototype.getInputGridSize = function(){
    return this.inputGridSize;
}

MapViewEN.prototype.getInputImage = function(){
    return this.inputImage;
}

MapViewEN.prototype.getGSInputValue = function(){
    return parseInt(this.getInputGridSize().value);
}
function MapModel(i,gs) {
    this.image = this.createImage(i);
    this.gridSize = gs;
}

MapModel.prototype.getImage = function() {
    return this.image;
}

MapModel.prototype.setImage = function(i){
    this.image = i;
}

MapModel.prototype.createImage = function(raw){
    var img = new Image;
    if (raw instanceof File) {
        img.src = URL.createObjectURL(raw);
    } else if(typeof(raw) == 'string'){
        img.src = raw.replace('public', '/storage');
    }

    return img;
}

MapModel.prototype.getGridSize = function(){
    return this.gridSize;
}

MapModel.prototype.setGridSize = function(gs){
    this.gridSize = gs;
}
function MapController(mapView){

    this.view = mapView;    
     if(j){
        //construct model from global j  
        this.model = new MapModel(j.map_image, j.grid_size);
        this.model.getImage().onload = function(){
            this.view.redraw(this.model.getImage(), this.model.getGridSize());
        }.bind(this)
     } else {
        //or initialize empty model
        this.model = new MapModel();
    }
    this.os = {x: null,y: null};
     
}

MapController.prototype.registerInputListeners = function(){
    this.view.getInputImage().addEventListener('change', this.mapFileUpload.bind(this));
    this.view.getInputGridSize().addEventListener('change', this.gridInputChange.bind(this));

}

MapController.prototype.registerDataRequestListener = function(){
    this.view.getCanvas().addEventListener('click', this.fetchData.bind(this));
    this.view.getCanvas().addEventListener('mousemove', this.canvasHover.bind(this));
    this.view.getCanvas().addEventListener('mouseleave', this.redraw.bind(this));
    //reportSquare.bind(this)
}

MapController.prototype.canvasHover = function(e){
    var s = this.reportSquare(e);
    var gs = this.model.getGridSize();
    
    if( !(s.x == this.os.x && s.y == this.os.y)){
        this.redraw();
        this.view.getCtx().save();
        this.view.getCtx().fillStyle = "red";
        this.view.getCtx().globalAlpha = 30/100;
        this.view.getCtx().fillRect(
            (s.x - 1) * gs,
            (s.y.charCodeAt(0) - 65 )* gs,
            gs,gs)
        this.view.getCtx().restore();
        this.os = s;
    }
}

MapController.prototype.fetchData = function(e){
    var s = this.reportSquare(e);
    $.ajax(
        {
            url: '/search/square',
            type: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {square: s.y + "/" + s.x},
            success: function(data){
                v.renderSquareData(data);
                console.log('success');
                console.log(data);
            },
            error: function(o,s){
                console.log('error');
                console.log(o);
                console.log(s);
            }
        }
    )
    window.location = '/map#stats';

}

MapController.prototype.reportSquare = function(e){
    var offset = $(e.target).offset();
    var position = {x: e.pageX - offset.left, y: e.pageY - offset.top};
    var gs = this.model.getGridSize();
    return  {
        x: Math.ceil(position.x / gs),
        y: String.fromCharCode(64 + Math.ceil(position.y / gs))  
    };
}

MapController.prototype.mapFileUpload = function(e){

    if (e.target.files[0]){
        var img = this.model.createImage(e.target.files[0]); 
        this.model.setImage(img);
        img.onload = function() {
            this.view.redraw(img, this.model.getGridSize());
            //this.view.getInputGridSize().removeAttribute('disabled');
        }.bind(this)
    }
}

MapController.prototype.gridInputChange = function(){
    //update model
    this.model.setGridSize( this.view.getGSInputValue() );
    //redraw canvas
    this.view.redraw(
        this.model.getImage(),
        this.model.getGridSize()
    );
}

MapController.prototype.redraw = function(){
    this.view.redraw(
        this.model.getImage(),
        this.model.getGridSize()
    );
}