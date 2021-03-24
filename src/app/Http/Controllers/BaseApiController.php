<?php


namespace App\Http\Controllers;


use App\Traits\MessageCodes;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * @OA\Info(title="Test Application", version="0.1")
 */
class BaseApiController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,MessageCodes;
    /**
     * @OA\SecurityScheme(
     *   securityScheme="bearerAuth",
     *   in="header",
     *   name="Authorization",
     *   type="http",
     *   scheme="bearer",
     *   bearerFormat="JWT",
     * ),
     **/
    /**
     * JsonResponse с данными
     *
     * @param array $data
     * @param int $statusCode
     *
     * @return JsonResponse
     */

    protected function responseWithData($data = [], int $statusCode = 200): JsonResponse
    {
        $response = [
            'message'=>$this->getMessage($statusCode),
            'data' => $data
        ];
        return $this->responseWith($response, $statusCode);
    }

    /**
     * JsonResponse с сообщением
     *
     * @param int $statusCode
     *
     * @return JsonResponse
     */

    protected function responseWithMessage(int $statusCode = 200): JsonResponse
    {
        $response = [
            'message' => $this->getMessage($statusCode),
            'data'=>[]
        ];

        return $this->responseWith($response, $statusCode);
    }

    /**
     * JsonResponse с ошибками валидации
     *
     * @param $validationErrors
     *
     * @return JsonResponse
     */

    protected function responseValidationErrors($validationErrors)
    {
        return $this->responseWith($validationErrors, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Генерировать JsonResponse
     *
     * @param array $response
     * @param int $statusCode
     *
     * @return JsonResponse
     */

    private function responseWith(array $response, int $statusCode): JsonResponse
    {
        return response()->json($response)->setStatusCode($statusCode);
    }
}

