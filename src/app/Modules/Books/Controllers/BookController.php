<?php


namespace App\Modules\Books\Controllers;


use App\Http\Controllers\BaseApiController;
use App\Modules\Authors\DTO\CreateAuthorDTO;
use App\Modules\Authors\Resources\AuthorResource;
use App\Modules\Books\DTO\CreateBookDTO;
use App\Modules\Books\DTO\UpdateBookDTO;
use App\Modules\Books\Repository\BookReadRepositoryInterface;
use App\Modules\Books\Repository\BookWriteRepositoryInterface;
use App\Modules\Books\Requests\CreateBookRequest;
use App\Modules\Books\Requests\UpdateBookRequest;
use App\Modules\Books\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends BaseApiController
{
    public BookReadRepositoryInterface $readRepository;
    public BookWriteRepositoryInterface $writeRepository;

    public function __construct(BookReadRepositoryInterface $bookReadRepository,
                                BookWriteRepositoryInterface $writeRepository)
    {
        $this->readRepository = $bookReadRepository;
        $this->writeRepository = $writeRepository;
    }

    /**
     * @OA\Get(path="/api/v1/book",
     *   tags={"book"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Get a list of books",
     *   description="",
     *   operationId="index",
     *   @OA\Response(
     *     response=200,
     *     description="success",
     *     @OA\Schema(type="string"),
     *   ),
     * )
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->responseWithData(BookResource::collection($this->readRepository->all()));
    }

    /**
     * @OA\Get(path="/api/v1/book/{id}",
     *   tags={"book"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Get one book with all authors",
     *   description="",
     *   operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Book id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         ),
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *   ),
     * )
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $model = $this->readRepository->first($id);
        if (empty($model)) {
            return $this->responseWithMessage(Response::HTTP_NOT_FOUND);
        }
        return $this->responseWithData(new BookResource($model));
    }

    /**
     * @OA\Get(path="/api/v1/book/getBooksByAuthorId/{id}",
     *   tags={"book"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Get a list of books by a specific author",
     *   description="",
     *   operationId="getBooksByAuthorId",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Author id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         style="form"
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\Schema(type="string"),
     *   ),
     * )
     * @param $id
     */
    public function getBooksByAuthorId($id): \Illuminate\Http\JsonResponse
    {
        $model = $this->readRepository->getBooksByAuthorId($id);
        if (empty($model)) {
            return $this->responseWithMessage(Response::HTTP_NOT_FOUND);
        }
        return $this->responseWithData(BookResource::collection($model));
    }

    /**
     * @OA\Post(
     *   path="/api/v1/book",
     *   tags={"book"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Create new Book",
     *   description="",
     *   operationId="store",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="name book",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="description",
     *                   description="about book",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="400",description="Validate error"),
     *   @OA\Response(response="200",description="Success create element"),
     * ) *
     * @param CreateBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBookRequest $request): \Illuminate\Http\JsonResponse
    {
        $model = $this->writeRepository
            ->create(new CreateBookDTO(
                    $request->get('name'), $request->get('description'))
            );
        if (!$model) {
            return $this->responseWithMessage(500);
        }
        return $this->responseWithData(new BookResource($model), Response::HTTP_CREATED);

    }

    /**
     * @OA\Put(
     *   path="/api/v1/book/{id}",
     *   tags={"book"},
     *   security={
     *     {"bearerAuth": {}}
     *   },
     *   summary="Updates a book in the store with form data",
     *   description="",
     *   operationId="update",
     *   @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="name",
     *                   description="Updated name of the book",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="description",
     *                   description="Updated description of the book",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of book that needs to be updated",
     *     required=true,
     *     @OA\Schema(
     *         type="integer",
     *         format="int64"
     *     )
     *   ),
     *   @OA\Response(response="500",description="Error in server"),
     *   @OA\Response(response="400",description="Validate error"),
     * )
     * @param $id
     * @param UpdateBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateBookRequest $request): \Illuminate\Http\JsonResponse
    {
        $model = $this->writeRepository
            ->update($id, new UpdateBookDTO(
                    $request->get('name'), $request->get('description'))
            );
        if (!$model) {
            return $this->responseWithMessage(500);
        }
        return $this->responseWithData(new BookResource($model), Response::HTTP_ACCEPTED);

    }

}
