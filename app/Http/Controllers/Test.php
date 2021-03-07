<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Route::get('/test')
        $index = ["C++","Java","c#","C++","Java","c#"];
        return $index ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Route::get('/test/create')
        $create = ["create","create","create","create","create"];
        return $create ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Route::post('/test')
        $store = ["store","store","store","store","store"];
        return $store ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Route::get('/test/{id}')
        $show = ["show0","show1","show2","show3","show4"];
        return $show[$id] ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Route::get('/test/{id}/edit')
        $edit = ["edit0","edit1","edit2","edit3","edit4"];
        return $edit[$id] ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Route::put('/test/{id}')
        $update = ["update0","update1","update2","update3","update4"];
        return $update[$id] ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Route::delete('/test/{id}')
        $destroy = ["destroy","destroy","destroy","destroy","destroy"];
        return $destroy ;
    }
}