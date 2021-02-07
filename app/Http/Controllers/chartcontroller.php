<?php

namespace App\Http\Controllers;

use App\expense;
use App\catman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\exprequest;
use Carbon\Carbon;
use DB;
class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function xlist()
    {
       
        $catposting = DB::select(' SELECT c.categoryname CATEGORY, sum(e.amount) AMOUNT
        FROM
        category c
        LEFT JOIN
        expenses e ON
        c.categoryname = e.categoryname
        GROUP BY c.categoryname
        ORDER BY c.categoryname;');
     


        return $catposting;
    }
    public function xchart()
    {
       
        $exposting = expense::where('uid', '=', auth()->id())->get();
        return response()->json($exposting);
    }
    public function index()
    {
        
        if(auth()->id()) 
        {
            $currentid= auth()->id();
            $exposting = catman::all();
           // $catposting = catman::all();
           
           $result = DB::select(" SELECT c.categoryname CATEGORY, sum(e.amount) AMOUNT
           FROM
           category c 
           LEFT JOIN
           expenses  e ON
           c.categoryname = e.categoryname
           WHERE e.deleted_at IS NULL
           AND e.uid = $currentid 
           GROUP BY c.categoryname
           ORDER BY c.categoryname;");
        
         $catposting = json_decode(json_encode($result), true);

          
      $catposting= json_encode($catposting);
       
        //return $catposting;
              return view('home',compact('catposting','exposting','currentid'));
        }
        else{
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
     
        $xl = expense::where('categoryname', '=',$id);
        return response()->json($xl);
        //
    }

}
