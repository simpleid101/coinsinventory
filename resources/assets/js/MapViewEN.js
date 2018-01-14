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