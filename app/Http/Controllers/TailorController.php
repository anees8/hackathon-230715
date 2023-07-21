<?php

namespace App\Http\Controllers;

use App\Models\Tailor;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class TailorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        
        $data['tailors'] = Tailor::with('productTypes')->paginate($request->perPage);  
        return $this->sendResponse($data, 'Tailors return successfully.', Response::HTTP_OK);
        
    }

    public function orders(Request $request,$id){

        $tailorProductTypes=Tailor::with('productTypes')->Where('id',$id)->first()->productTypes->pluck('name');
        
        $data['orders']= Order::with(['sku.size','sku.product_type'])
        ->whereHas('sku.product_type', function ($query) use ($tailorProductTypes) {
            $query->whereIn('name', $tailorProductTypes);
        })->Paginate($request->perPage);
        return $this->sendResponse($data,'Orders return successfully.',Response::HTTP_OK);
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
                'required', 'min:2',
            ],
            'phone' => [
                'required', 'digits_between:10,10', 'unique:tailors,phone,',
            ], 
            
            'address' => [
                'required', 'min:5'
            ],
            'email' => [
                'email', 'unique:tailors,email',
            ],
            'commission_limit' => [
                'max:1111',
            ],
            'max_units_per_day' => [
                'max:10',
            ],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $data['tailor'] = Tailor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'commission_limit' => $request->commission_limit,
            'email' => $request->email,
            'max_units_per_day' => $request->max_units_per_day,
        ]);
        return $this->sendResponse($data, 'Tailor register successfully.', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tailor $tailor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tailor $tailor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tailor $tailor)
    {
        $validator = Validator::make($request->all(), [
            'name' => [
                'required', 'min:2',
            ],
            'phone' => [
                'required', 'digits_between:10,10', 'unique:tailors,phone,'. $tailor->id
            ], 
            
            'address' => [
                'required', 'min:5'
            ],
            'email' => [
                'email', 'unique:tailors,email,'. $tailor->id
            ],
            'commission_limit' => [
                'max:1111',
            ],
            'max_units_per_day' => [
                'max:10',
            ],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        $tailor->name =  $request->name;    
        $tailor->email =  $request->email;   
        $tailor->phone =  $request->phone;  
        $tailor->address =  $request->address;  
        $tailor->commission_limit =  $request->commission_limit;  
        $tailor->max_units_per_day =  $request->max_units_per_day;          
        $tailor->update();
        return $this->sendResponse('Tailor Updated Successfully.',Response::HTTP_OK);



        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tailor $tailor)
    {
        $tailor->delete();
        return $this->sendResponse('Taolor Deleted Successfully.',Response::HTTP_OK);
    }
}