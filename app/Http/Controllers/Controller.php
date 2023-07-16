<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // 200 - HTTP_OK- success/OK 
// 201 - HTTP_CREATED-  CREATED - used in POST or PUT methods.
// 304 - NOT MODIFIED - used in conditional GET requests to reduce the bandwidth use of the network. Here, the body of the response sent should be empty.
// 400 - BAD REQUEST - This can be due to validation errors or missing input data.
// 401- UNAUTHORIZED - This is returned when there is no valid authentication credentials sent along with the request.
// 403 - FORBIDDEN - sent when the user does not have access (or is forbidden) to the resource.
// 404 - NOT FOUND - Resource method is not available.
// 500 - INTERNAL SERVER ERROR - server threw some exceptions while running the method.
// 502 - BAD GATEWAY - Server was not able to get the response from another upstream server


public function sendResponse($result, $message)
{
    $response = [
        'success' => true,
        'data'    => $result,
        'message' => $message,
    ];
    return response()->json($response, 200);
}

public function sendError($error, $errorMessages = [], $code = 404)
{

    
    $response = [
        'success' => false,
        'message' => $error,
    ];

    if(!empty($errorMessages)){
        $response['errors'] = $errorMessages;
    }
    
    return response()->json($response, $code);
}

}
