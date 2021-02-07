<?php

namespace App\Http\Controllers;

use App\expense;
use App\catman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\exprequest;
use Carbon\Carbon;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        if(auth()->id()) 
        {
        $currentid= auth()->id();
        
        $catposting = catman::all();
        $exposting = expense::where('uid', '=', auth()->id())->get();
       // $exposting = expense::all( {{ Auth::user()->name }});
        return view('expense.index',compact('exposting','catposting','currentid'));
        }
        else{
            
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
    public function store(exprequest $exprequest, expense $expense)
    {
        $posting =  expense::create([
            'categoryname' => $exprequest['categoryname'],
            'amount' => $exprequest['amount'],
            'entrydate' => $exprequest['entrydate'],
            'uid' => $exprequest['uid'],
            ]);
            return response()->json(['message' => 'saved','data'=>$posting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(exprequest $exprequest, expense $expense)
    {
        $exposting = $expense->update($exprequest->all());
        return response()->json(['message' => 'Updated','data'=>$exposting]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $user = expense::find($id);
       if(!is_null($user)){
           $user->Deleted_at = Carbon::now();
           $user->save();
        return response()->json(['message' => 'Deleted']);
   
        //
    }
}
}
