<?php

namespace App\Http\Controllers;

use App\Models\calculo;
use Illuminate\Http\Request;

class CalculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('index'); 

    }



    public function store(Request $request)
    {

        //dd($request->all());
        return view('calc');

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\calculo  $calculo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\calculo  $calculo
     * @return \Illuminate\Http\Response
     */
    public function edit(calculo $calculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\calculo  $calculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, calculo $calculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\calculo  $calculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(calculo $calculo)
    {
        // 
    }
}
