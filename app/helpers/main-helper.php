<?php

function res_json($status, $msg, $data = false)
{
    $data = [
        'status' => $status,
        'message' => $msg,
        'data' => $data
    ];
    echo json_encode($data);
}

function not_found_data($needed_requests)
{
    $diff = array_diff($needed_requests, array_keys($_POST));
    if (count($diff) == 0) return false;
    else return $diff;
}

if (!function_exists('getRequestHeaders')) {
    
    /**
     * get item or all items from request headers
     * 
     * @param string $header [default = null] header name
     * @param mixed $default [default = null] default value if header is not found
     * @return mixed
     */
    function getRequestHeaders(string $header = null, $default = null)
    {
        $headers = getallheaders();
        if (!$header) {
            return $headers;
        }

        if (array_key_exists($header, $headers)) {
            return $headers[$header];
        }

        return $default;
    }
}

if (!function_exists('isJsonRequest')) {
    /**
     * check if the incoming request accept json response
     * 
     * @return bool
     */
    function isJsonRequest(): bool
    {
        $acceptedResponse = getRequestHeaders('Accept');
        if (strpos('application/json', $acceptedResponse)) {
            return true;
        } else {
            return false;
        }
    }
}


if (!function_exists('forceHttpMethod')) {

    /**
     * handle request method type 
     * if the current request method match the given request it will pass
     * if not it will die
     * 
     * @param string $method 
     */
    function forceHttpMethod(string $method)
    {
        if ($_SERVER['REQUEST_METHOD'] !== ucwords($method)) {
            $method = $_SERVER['REQUEST_METHOD'];

            http_response_code(405);
            die("Error 405 : $method method is not allowed in this route");
           
        }
    }
}
