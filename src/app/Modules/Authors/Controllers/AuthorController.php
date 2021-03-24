<?php


namespace App\Modules\Authors\Controllers;


use App\Http\Controllers\BaseApiController;
use App\Modules\Authors\DTO\CreateAuthorDTO;
use App\Modules\Authors\Repository\AuthorWriteRepositoryInterface;
use App\Modules\Authors\Requests\CreateAuthorRequest;
use App\Modules\Authors\Resources\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends BaseApiController
{
    public AuthorWriteRepositoryInterface $authorWriteRepository;

    /**
     * AuthorController constructor.
     * @param AuthorWriteRepositoryInterface $authorWriteRepository
     */
    public function __construct(AuthorWriteRepositoryInterface $authorWriteRepository)
    {
        $this->authorWriteRepository = $authorWriteRepository;
    }


    /**
     * @OA\Post(
     *   path="/api/v1/author",
     *   tags={"author"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Create new author",
     *   description="",
     *   operationId="store",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="full_name",
     *                   description="name author",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="about",
     *                   description="about author",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="birth_date",
     *                   description="date birth author",
     *                   type="date"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description="Success create element"),
     * )
     * @param CreateAuthorRequest $request
     */
    public function store(CreateAuthorRequest $request): \Illuminate\Http\JsonResponse
    {
        $model = $this->authorWriteRepository
            ->create(new CreateAuthorDTO(
                    $request->get('full_name'), $request->get('birth_date'), $request->get('about'))
            );
        if (!$model) {
            return $this->responseWithMessage( 500);
        }
        return $this->responseWithData(new AuthorResource($model),  Response::HTTP_CREATED);

    }

}
