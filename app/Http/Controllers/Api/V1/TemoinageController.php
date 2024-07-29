<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Temoinage\TemoinageCollection;
use App\Http\Resources\Temoinage\TemoinageResource;
use App\Http\Requests\Temoinage\StoreTemoinageRequest;
use App\Http\Requests\Temoinage\UpdateTemoinageRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\ApiController;
use App\Models\Temoinage;
use Illuminate\Http\Request;

class TemoinageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TemoinageCollection(Temoinage::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemoinageRequest $request)
    {
        $temoinage = Temoinage::create($request->all());

        return new TemoinageResource($temoinage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temoinage  $temoinage
     * @return \Illuminate\Http\Response
     */
    public function show(Temoinage $temoinage)
    {
        return new TemoinageResource($temoinage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Temoinage  $temoinage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemoinageRequest $request, Temoinage $temoinage)
    {
        $temoinage->update($request->all());
        return new TemoinageResource($temoinage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temoinage  $temoinage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temoinage $temoinage)
    {
        $temoinage->delete();
        return response(null, 204);
    }
}
