


@include('shared.errors')


{{ csrf_field() }}
	
	<div class="row show-grid">
	
		<div class="col-sm-6">
		@if($coin->obverse_photo)
			<img src="{{$coin->obverse_photo}}" class="img-responsive  center-block" >
		@endif
		</div>
	

	
		<div class="col-sm-6">
		@if($coin->reverse_photo)
			<img src="{{$coin->reverse_photo}}" class="img-responsive  center-block" >
		@endif
		</div>
	
	</div>	

	<div class="row show-grid">

		@include('shared._field', ['name' => 'Bag #', 'type' => 'text', 'value' => old('bag_#', $coin->bag_number) ])	  
		@include('shared._field', ['name' => 'Field #', 'type' => 'text', 'value' => old('field_#', $coin->field_inventory) ]) 
	 </div>

	<div class="row show-grid">
	    @include('shared._field', ['name' => 'Emperor', 'type' => 'text', 'value' => old('emperor', $coin->emperor) ])
	    @include('shared._field', ['name' => 'Denomination', 'type' => 'text', 'value' => old('denomination', $coin->denomination) ]) 
	 </div> 

	<div class="row show-grid">
	    @include('shared._field', ['name' => 'Obverse', 'type' => 'text', 'value' => old('obverse', $coin->obverse) ])
	    @include('shared._field', ['name' => 'Reverse', 'type' => 'text', 'value' => old('reverse', $coin->reverse) ])
	 </div>

	<div class="row show-grid">
		<label for="mint" class="col-sm-1 control-label">Mint</label>
		<div class="col-sm-5">
			<select name="mint">
				@foreach(\App\Mint::all() as $mint)
				@php
					$selected = $coin->mint_id == $mint->id ? 'selected' : '';
				@endphp
					<option value="{{$mint->id}}" {{$selected}} >{{$mint->name}}</option>
				@endforeach
			</select>
		</div>

			<label for="mintmark" class="col-sm-1 control-label">Mintmark</label>
			<div class="col-sm-5">
				<select name="mintmark">
					@foreach(\App\Mintmark::all() as $mintmark)
					@php
						$selected = $coin->mintmark_id == $mintmark->id ? 'selected' : '';
					@endphp
						<option value="{{$mintmark->id}}" {{$selected}} >{{$mintmark->mark}}</option>
					@endforeach
				</select>
			</div>

	 </div>

	<div class="row show-grid">
	    @include('shared._field', ['name' => 'Weight', 'type' => 'text', 'required' => true, 'value' => old('weight', $coin->weight) ])
	    @include('shared._field', ['name' => 'Diameter', 'type' => 'text', 'value' => old('diameter', $coin->diameter) ])
	 </div>

	<div class="row show-grid">
	    @include('shared._field', ['name' => 'Emission', 'type' => 'text', 'value' => old('emission', $coin->emission) ])
	    @include('shared._field', ['name' => 'Axis', 'type' => 'text', 'value' => old('axis', $coin->axis) ]) 
	 </div>

	<div class="row show-grid">
	    @include('shared._field', ['name' => 'Date', 'type' => 'date', 'value' => old('date', $coin->find_date) ])
	    @include('shared._field', ['name' => 'Reference', 'type' => 'text', 'value' => old('reference', $coin->reference) ])
	 </div>

	 <div class="row show-grid">
	    @include('shared._field', ['name' => 'Square', 'type' => 'text', 'value' => old('square', $coin->square) ])
	 </div>

	<div class="row show-grid">
	    <label for="inputEmail3" class="col-sm-1 control-label">Location</label>
	    <div class="col-sm-10">
	      <textarea type="textarea" class="form-control" rows="3" id="location" name="location" placeholder="Location"
	       >{{old('location', $coin->location)}}</textarea>
	    </div> 
	 </div>

	<div class="row show-grid">
		<label for="obverse_photo" class="col-sm-1 control-label">Obverse</label>
		<div class="col-sm-5">
		  <input type="file" class="form-control" id="obverse_photo" name="obverse_photo" >
		</div>

		<label for="reverse_photo" class="col-sm-1 control-label">Reverse</label>
		<div class="col-sm-5">
		  <input type="file" class="form-control" id="reverse_photo" name="reverse_photo" >
		</div>	    
	 </div>

<div class="row">
	  <div class="form-group">
	    <div class="col-sm-10">
	      <button type="submit" class="btn btn-default">Submit</button>
	    </div>
	  </div>
	</div>


