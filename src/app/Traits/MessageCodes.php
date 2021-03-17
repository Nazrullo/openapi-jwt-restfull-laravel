<?php


namespace App\Traits;


use Illuminate\Http\Response;

trait MessageCodes
{

    protected function getMessage($status)
    {
        $statusCodes = [
            Response::HTTP_OK => 'Success',
            Response::HTTP_CREATED => 'Success create element',
            Response::HTTP_ACCEPTED => 'Success update element',
            Response::HTTP_NO_CONTENT => 'Success delete element',
            Response::HTTP_BAD_REQUEST => 'Validate Error',
            Response::HTTP_NOT_FOUND => 'Not found',
            Response::HTTP_INTERNAL_SERVER_ERROR => 'Error in server'
        ];
        return $statusCodes[$status];
    }

}
