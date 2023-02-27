<?php

namespace App\Http\Controllers\V1\Programs;

use App\Constants\RecordStatusConstants;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Programs\ProgramReportRepository;
use App\Http\Requests\ProgramRequest;
use App\Http\Requests\ProgramUpdateRequest;
use App\Http\Resources\ProgramResource;
use App\Repositories\V1\ProgramRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProgramsController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Program Repository class.
     *
     * @var ProgramRepository;
     */
    public $programRepository;

    public function __construct(ProgramRepository $programRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->programRepository = $programRepository;
    }

    /**
     * @OA\GET(
     *     path="/api/programs",
     *     tags={"Programs"},
     *     summary="Get Programs",
     *     description="Get Programs as Array",
     *     operationId="indexP",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Programs as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->programRepository->getAll();
            return $this->responseSuccess($data, 'Programs Results!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/programs/view/all",
     *     tags={"Programs"},
     *     summary="All Programs - Publicly Accessible",
     *     description="All Programs - Publicly Accessible",
     *     operationId="indexAllP",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Programs - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->programRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Programs Results!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/programs/view/search",
     *     tags={"Programs"},
     *     summary="All Programs - Publicly Accessible",
     *     description="All Programs - Publicly Accessible",
     *     operationId="searchP",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="search", description="search, eg; Test", example="Test", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="All Programs - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->programRepository->searchProgram($request->search, $request->perPage);
            return $this->responseSuccess($data, 'Programs Results!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/programs",
     *     tags={"Programs"},
     *     summary="Create A New Program",
     *     description="Create A New Program",
     *     operationId="storeP",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Program 1"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="start_date", type="integer", example=1677449733),
     *              @OA\Property(property="end_date", type="integer", example="1677449733"),
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Create a New Program" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function store(ProgramRequest $request): JsonResponse
    {
        try {
            $program = $this->programRepository->create($request->all());
            return $this->responseSuccess($program, 'New Program Created!');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\GET(
     *     path="/api/programs/{id}",
     *     tags={"Programs"},
     *     summary="Show Program Details",
     *     description="Show Programs Details",
     *     operationId="showP",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Programs Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->programRepository->getByID($id);
            if (is_null($data)) {
                return $this->responseError(null, 'Program Not Found', Response::HTTP_NOT_FOUND);
            }

            return $this->responseSuccess($data, 'Program Found!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\PUT(
     *     path="/api/programs/{id}",
     *     tags={"Programs"},
     *     summary="Update A Program",
     *     description="Update A Program",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Product 1"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="pentesting_start_date", type="integer", example=1677449733),
     *              @OA\Property(property="pentesting_end_date", type="integer", example="1677449733"),
     *              @OA\Property(property="image", type="string", example=""),
     *          ),
     *      ),
     *     operationId="update",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Update A Program"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function update(ProgramUpdateRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->programRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Program Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Program Updated Successfully!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/programs/{id}",
     *     tags={"Programs"},
     *     summary="Delete A Program",
     *     description="Delete A Program",
     *     operationId="destroyP",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete A Program"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $program =  $this->programRepository->getByID($id);
            if (empty($program)) {
                return $this->responseError(null, 'Program Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->programRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the program.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            $program['record_status'] =  RecordStatusConstants::STATUS['0']['value'];
            return $this->responseSuccess(new ProgramResource($program), 'Program Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
