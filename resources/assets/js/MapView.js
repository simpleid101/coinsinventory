

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