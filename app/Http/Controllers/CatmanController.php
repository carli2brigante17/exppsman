<?php

namespace App\Http\Controllers;

use App\catman;
use Illuminate\Http\Request;
use App\Http\Requests\catreq;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\usermanager;
class CatmanController extends Controller
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
        $catposting = catman::all();
        return view('category.index',compact('catposting'));
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
    public function store(catreq $catreq,catman $catman)

    {
        $catposting =  catman::create([
            'categoryname' => $catreq['categoryname'],
            'description' => $catreq['description'],
         
            ]);
            return response()->json(['message' => 'saved','data'=>$catposting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\catman  $catman
     * @return \Illuminate\Http\Response
     */
    public function show(catman $catman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\catman  $catman
     * @return \Illuminate\Http\Response
     */
    public function edit(catman $catman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\catman  $catman
     * @return \Illuminate\Http\Response
     */
    public function update(catreq $catreq, catman $catman)
    {
        $cat = catman::find($catreq->input('id'));
        if(!is_null($cat)){
            $cat->categoryname = $catreq->input('categoryname');
            $cat->description = $catreq->input('description');
            $cat->save();
            return response()->json(['message' => 'Updated na']);
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\catman  $catman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = catman::find($id);
        if(!is_null($cat)){
            $cat->Deleted_at = Carbon::now();
            $cat->save();
         return response()->json(['message' => 'Deleted']);
        }
    }
}
