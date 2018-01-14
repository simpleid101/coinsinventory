@extends('shared.master')
@extends('shared.nav')
@section('main')

<div class="row">
  <div class="col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1">
    <div class="thumbnail">
			<div class="col-sm-6">
      <img src="{{Storage::url($coin->obverse_photo)}}" class="img-responsive" alt="...">
			</div>
			<div class="col-sm-6">
			<img src="{{Storage::url($coin->reverse_photo)}}" class="img-responsive" alt="...">
			</div>

			<div class="col-sm-6">
				<div class="caption">
					<h4>Bag Number</h4>
					<p>{{$coin->bag_number}}</p>
				</div>
			</div>

			<div class="col-sm-6">			
				<div class="caption">
					<h4>Field Number</h4>
					<p>{{$coin->bag_number}}</p>
				</div>
			</div>



  

		<div class="col-sm-6">
				<div class="caption">
					<h4>Emperor</h4>
					<p>{{$coin->emperor}}</p>
				</div>
		</div>

<div class="col-sm-6">
    <div class="caption">
        <h4>Denomination</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">	
			<div class="caption">
        <h4>Obverse</h4>
        <p>{{$coin->obverse}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Reverse</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Mint</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Mintmark</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Diameter</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Weight</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Emission</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Axis</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Date</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>

<div class="col-sm-6">
      <div class="caption">
        <h4>Reference</h4>
        <p>{{$coin->bag_number}}</p>
      </div>
</div>
     
<div class="col-sm-6">
		  <div class="caption">
        <h4>Square</h4>
        <p>{{$coin->square}}</p>
      </div>
</div>

<div class="col-sm-6">
		  <div class="caption">
        <h4>Location</h4>
        <p>{{$coin->location}}</p>
      </div>
</div>
		  




			<div class="caption">
        <p>
					<a href="{{action('CoinController@edit', ['id' => $coin->id])}}" class="btn btn-warning" role="button">Edit</a>
					<!-- <a href="{{action('CoinController@destroy', ['id' => $coin->id])}}" class="btn btn-danger" role="button">Delete</a> -->
					<form method="post" class= action="{{ action('CoinController@destroy', ['id' => $coin->id ]) }}">
                    <input type="hidden" name="_method" value="delete">
                    {{ csrf_field() }}
                    <button class="btn btn-danger" type="submit" >Delete</button>
                </form>
				</p>
      </div>
    </div>
  </div>

</div>

    
	 </div>
@endsection