<?php

namespace App\Http\Controllers;

use App\usermanager;
use Illuminate\Http\Request;
use App\Http\Requests\usermanagerrequest;
use App\Http\Requests\usereq;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\role;


class UsermanagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $tsk = usermanager::where('id', '=', auth()->id())->
        where('role','=','Administrator')->
        get();
        
        //return($tsk);
        if($tsk->isempty())
    {

        //return view('login');

     
    }
        else{
            $roleposting=role::all();
            $posting = usermanager::all();
            return view('usermanager.index',compact('posting','roleposting'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(usermanagerrequest $usermanagerrequest,usermanager $usermanager)
    {
       // $posting = $usermanager::create($usermanagerrequest->all());
        //
        $posting =  usermanager::create([
            'name' => $usermanagerrequest['name'],
            'email' => $usermanagerrequest['email'],
            'role' => $usermanagerrequest['role'],
            'password' => Hash::make($usermanagerrequest['password']),
            ]);
            return response()->json(['message' => 'saved','data'=>$posting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\usermanager  $usermanager
     * @return \Illuminate\Http\Response
     */
    public function show(usermanager $usermanager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usermanager  $usermanager
     * @return \Illuminate\Http\Response
     */
    public function edit(usermanager $usermanager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usermanager  $usermanager
     * @return \Illuminate\Http\Response
     */
    public function update(usereq $usereq, usermanager $usermanager)
    {
        $posting = $usermanager->update($usereq->all());
        return response()->json(['message' => 'Updated','data'=>$posting]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usermanager  $usermanager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $usermanager->delete();
       $user = Usermanager::find($id);
       if(!is_null($user)){
           $user->Deleted_at = Carbon::now();
           $user->save();
        return response()->json(['message' => 'Deleted']);
       }
    }
}
