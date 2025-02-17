<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Signaler\SignalerResource;
use App\Http\Requests\Signaler\StoreSignalerRequest;
use App\Models\Signaler;
use Illuminate\Http\Request;

class SignalerController extends Controller
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
    // public function store(Request $request)
    // {
    //     //
    // }
    public function store(StoreSignalerRequest $request)
    {
        $signaler = Signaler::create($request->all());

        return new SignalerResource($signaler);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signaler  $signaler
     * @return \Illuminate\Http\Response
     */
    public function show(Signaler $signaler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signaler  $signaler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signaler $signaler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signaler  $signaler
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signaler $signaler)
    {
        //
    }
}
