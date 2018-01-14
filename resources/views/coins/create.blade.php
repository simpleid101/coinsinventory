@extends('shared.header')
@extends('shared.nav')

@section('main')

<div class="row">

	<form method="post" action="{{url('coins')}}" enctype="multipart/form-data">
		
		@include('shared.form')

	</form>
</div>
@endsection

@extends('shared.footer')