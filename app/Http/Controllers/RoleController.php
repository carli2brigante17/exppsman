<?php

namespace App\Http\Controllers;

use App\role;
use App\usermanager;
use Illuminate\Http\Request;
use App\Http\Requests\rolereq;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class RoleController extends Controller
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

        //return response()->json(['message' => 'saved','data'=>$tsk]);
        if(!$tsk->isempty())
    {
        $roleposting = role::all();
        return view('role.index',compact('roleposting'));
        }
        else {
            return view('home');
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
    public function store(rolereq $rolereq ,role $role)
    {
        
        $roleposting =  role::create([
            'role' => $rolereq['role'],
            'description' => $rolereq['description'],
         
            ]);
            return response()->json(['message' => 'saved','data'=>$roleposting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(rolereq $rolereq ,role $role)
    {
        $roleposting = $role->update($rolereq->all());
        return response()->json(['message' => 'Updated','data'=>$roleposting]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rol = role::find($id);
        if(!is_null($rol)){
            $rol->Deleted_at = Carbon::now();
            $rol->save();
         return response()->json(['message' => 'Deleted']);
        }
    }
}
