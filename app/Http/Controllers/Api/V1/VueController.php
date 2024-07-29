<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vue\VueResource;
use App\Http\Requests\Vue\StoreVueRequest;
use App\Models\Vue;
use Illuminate\Http\Request;

class VueController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVueRequest $request)
    {
        $vue = Vue::create($request->all());

        return new VueResource($vue);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vue  $vue
     * @return \Illuminate\Http\Response
     */
    public function show(Vue $vue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vue  $vue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vue $vue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vue  $vue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vue $vue)
    {
        //
    }
}
