@extends('layouts.app')

 
@section('content')  
@include('sidebar')     


<div class="container">

</div>

<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<div class="card-body">
    <div id="app">
   
       
    <chartinf-component :exposting="{{$exposting}}" :catposting="{{$catposting}}">
  
    </chartinf-component>
    <chart-component :currentid="{{Auth::user()}}"/>


    </div>



    </div></div></div></div>
    @endsection
<script src = "{{asset('js/app.js')}}"></script>
<script>
function myclear() {
   
  document.getElementById("add").reset();
}
</script>


