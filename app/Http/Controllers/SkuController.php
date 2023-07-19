<?php

namespace App\Http\Controllers;

use App\Models\Sku;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use App\Rules\MinumFiveUniqueNameRule;
use App\Rules\UniqueSizeForSkuRule;


class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['skus']= Sku::with('size')->Paginate($request->perPage);
        return $this->sendResponse($data, 'Skus return successfully.',Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
                'alpha_num:ascii',
                'min:4',
                new MinumFiveUniqueNameRule
            ],
            'price' => 'required|numeric|min:345|max:995',
            'size_id' => 'required|numeric|in:1,2,3,4,5',
        ]);
      
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }

            $data['skus'] =   Sku::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'size_id'=>$request->size_id
            ]);
            
        return $this->sendResponse($data, 'Sku register successfully.',Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sku $sku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sku $sku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sku $sku)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'uppercase',
                'alpha_num:ascii',
                'min:4',
                new MinumFiveUniqueNameRule($sku->id)
            ],
            'price' => 'required|numeric|min:345|max:995',
            'size_id' => 'required|numeric|in:1,2,3,4,5',
        ]);
      
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);       
        }
        $sku->name =  $request->name;  
        $sku->price =  $request->price;  
        $sku->size_id =  $request->size_id;  
        $sku->update();
        return $this->sendResponse('Sku Updated Successfully.',Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sku $sku)
    {
        $sku->delete();
        return $this->sendResponse('Sku Deleted Successfully.',Response::HTTP_OK);
    }
}