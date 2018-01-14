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