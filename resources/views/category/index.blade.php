@extends('layouts.app')


 
@section('content')  
@include('sidebar') 



<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<div class="card-body">
    <div id="app">
   

    <catmanager-component :catposting="{{$catposting}}"/>


    </div>

    <button type="button"  class="btn btn-primary" onclick="myclear()" data-toggle="modal" data-target="#addu">
                      Add Category
                    </button>

    </div></div></div></div>
    @endsection
<script src = "{{asset('js/app.js')}}"></script>
<script>
function myclear() {
   
  document.getElementById("add").reset();
}
</script>


