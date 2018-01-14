 @php
	$n1 = str_replace(' ', '_', strtolower($name));
@endphp
<label for="inputEmail3" class="col-sm-1 control-label">{{$name}}</label>
<div class="col-sm-5">
  <input type="{{$type}}" class="form-control" id="{{$n1}}" name="{{$n1}}"  placeholder="{{$name}}"
    
    value="{{$value}}" 
    >
</div>