<?php

class Response
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message,$type = "JSON")
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'code'    => 200
        ];

        if(strtoupper($type) == "JSON"){
            return json_encode($response);
        }else{
            return $result;
        }
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404,$type = "JSON")
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        if(strtoupper($type) == "JSON"){
            return json_encode($response);
        }else{
            return $error;
        }
    }
}
?>