<?php

namespace App\Http\Controllers;

use App\Models\code;
use App\Http\Requests\StorecodeRequest;
use App\Http\Requests\UpdatecodeRequest;

class CodeController extends Controller
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
     * @param  \App\Http\Requests\StorecodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecodeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function show(code $code)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(code $code)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecodeRequest  $request
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecodeRequest $request, code $code)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(code $code)
    {
        //
    }
}
