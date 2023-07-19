<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;


class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sizes']= Size::all();
        return $this->sendResponse($data, 'Sizes return successfully.',Response::HTTP_OK);
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
                'uppercase',
                'unique:sizes,name',
                'in:XS,S,M,L,XL',
            ],
           
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }        

            $data['size'] =   Size::create([
            'name'=>$request->name
            ]);
        return $this->sendResponse($data, 'Size register successfully.',Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'uppercase',
                'unique:sizes,name,'. $size->id,
                'in:XS,S,M,L,XL',
            ],
           
        ]);

       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }

        $size->name =  $request->name;  
        $size->update();
        return $this->sendResponse('Size Updated Successfully.',Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return $this->sendResponse('Size Deleted Successfully.',Response::HTTP_OK);
    }
}
