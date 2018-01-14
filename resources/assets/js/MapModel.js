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