@extends('layouts.app')


 
@section('content')  
@include('sidebar') 


<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<div class="card-body">
    <div id="app">
   

    <expmanager-component :exposting="{{$exposting}}" :catposting="{{$catposting}}" :currentid="{{Auth::user()}}"/>


    </div>

    <button type="button"  class="btn btn-primary" onclick="myclear()" data-toggle="modal" data-target="#addu">
                      Add Expenses
                    </button>

    </div></div></div></div>
    @endsection
<script src = "{{asset('js/app.js')}}"></script>
<script>
function myclear() {
   
  document.getElementById("add").reset();
}
</script>


