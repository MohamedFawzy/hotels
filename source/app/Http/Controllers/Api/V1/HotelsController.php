<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\EntityNotFound;
use App\Hotel;
use App\Http\Requests\StoreHotelPost;
use App\Services\Hotels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
/**
 * @author Mohamed fawzy
 */
class HotelsController extends Controller
{

    private $service;

    public function __construct(Hotels $hotels)
    {
        $this->service = $hotels;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
            $result = $this->service->findAll();
        }catch (ValidationException $e){
            return response()->json(['status'=>'false', 'message'=> $e->getMessage()], 422);
        }catch (\Exception $e){
            return response()->json(['status'=>'false', 'message' => 'Exception happens due execute your query'], 500);
        }
        return response()
            ->json([
                'model' => $result['model'],
                'columns' => $result['columns']
            ]);
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
    public function store(StoreHotelPost $request)
    {
        try{

            $name = $request->input('name');
            $city = $request->input('city');
            $price = $request->input('price');
            $availability = $request->input('availability');
            // hydrate request
            $this->service->store($name, $city, $price, $availability);
        }catch (\ErrorException $e){
            return response()->json([], 503);
        }
        return response()
            ->json([
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try{
            $result = $this->service->find($id);
        }catch (\Exception $e){
            return response()->json(['error happens due execute your query'], 503);
        }

        return response()->json([
           'data' => $result
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHotelPost $request, $id)
    {
        try {

            $name = $request->input('name');
            $city = $request->input('city');
            $price = $request->input('price');
            $availability = $request->input('availability');
            // hydrate request
            $this->service->update($name, $city, $price, $availability, $id);
        }catch (EntityNotFound $e){
            return response()->json([], 404);
        }catch (\ErrorException $e){
            return response()->json([], 503);
        }
        return response()
            ->json([
            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $this->service->delete($id);
        }catch (\Exception $e){
            return response()
                ->json([
                ], 503);
        }


        return response()
            ->json([
            ], 201);
    }
}
