@extends('shared.header')
@extends('shared.nav')

@section('main')


<div class="row">
	<form method="post" action="{{action('CoinController@update', ['id'=> $coin->id ]) }}" enctype="multipart/form-data">
		<input type="hidden" name="_method" value="PUT">
		@include('shared.form')

	</form>
</div>
@endsection

@extends('shared.footer')