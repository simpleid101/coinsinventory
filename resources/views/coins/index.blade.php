@extends('shared.master')
@extends('shared.nav')
@section('main')

<!-- <div class="row">
    <div class="col-sm-12">
        <h1>Coinorama</h1>
        <canvas width="600" height="400"></canvas>
    </div>
</div> -->

<div class="row">
@if(Session::has('status'))
    <div class="col-sm-12 alert alert-{{session('status')['state']}} alert-dismissible ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('status')['msg'] }}
    </div>
@endif
<div class="col-sm-12 table-responsive">
    <table id="coins-table" class="table table-striped display">
        <thead>
        <tr>
            <th>ID</th>
            <th>Bag #</th>
            <th>Field #</th>
            <th>Emperor</th>
            <th>Denomination</th>
            <th>Mint</th>
            <th>Mintmark</th>
            <th>Weight</th>
            <th>Diameter</th>
            <th>Emission</th>
            <th>Axis</th>
            <th>Date</th>
            <th>Reference</th>
            <th>Square</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>

        </tbody>
    </table>
    
</div>

<!--         <div class="col-sm-4">dfs</div>
        <div class="col-sm-4">fds</div>
        <div class="col-sm-4">sdf</div>
 -->
</div>

@endsection


    @extends('shared.footer')
