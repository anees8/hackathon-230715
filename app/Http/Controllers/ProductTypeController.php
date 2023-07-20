<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['product_types']= ProductType::Paginate($request->perPage);
        return $this->sendResponse($data, 'Product Types return successfully.',Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'lowercase',
                'unique:product_types,name',
            ],
           
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }        

            $data['product_type'] =   ProductType::create([
            'name'=>$request->name
            ]);
        return $this->sendResponse($data, 'Product Type register successfully.',Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $productType)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'lowercase',
                'unique:product_types,name,'. $productType->id,
            ],
           
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }

        $productType->name =  $request->name;  
        $productType->update();
        return $this->sendResponse('Product Type Updated Successfully.',Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        $productType->delete();
        return $this->sendResponse('Product Type Deleted Successfully.',Response::HTTP_OK);
    }
}
