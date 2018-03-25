<?php

namespace App\Http\Controllers\Api\V1;

use App\Hotel;
use App\Services\Hotels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
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
//
//        $model = Hotel::SearchSortPaginationCriteria();
//        $columns = Hotel::$columns;
//
//        return response()
//                ->json([
//                   'model' => $model,
//                   'columns' => $columns
//                ]);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
