<?php

namespace App\Http\Controllers;

use App\Models\gameData;
use Illuminate\Http\Request;

class GameDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gameData  $gameData
     * @return \Illuminate\Http\Response
     */
    public function show(gameData $gameData)
    {
        return response($gameData, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gameData  $gameData
     * @return \Illuminate\Http\Response
     */
    public function edit(gameData $gameData)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gameData  $gameData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, gameData $gameData)
    {
        $gameData->update($request->all());
        return response($gameData, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gameData  $gameData
     * @return \Illuminate\Http\Response
     */
    public function destroy(gameData $gameData)
    {
        //
    }
}
