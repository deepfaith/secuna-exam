<?php

namespace App\Http\Controllers\V1\Programs;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramReportRequest;
use App\Repositories\V1\ProgramReportRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProgramReportsController extends Controller
{
    /**
     * Response trait to handle return responses.
     */
    use ResponseTrait;

    /**
     * Program Repository class.
     *
     * @var ProgramReportRepository;
     */
    public $programReportRepository;

    public function __construct(ProgramReportRepository $programReportRepository)
    {
        $this->middleware('auth:api', ['except' => ['indexAll']]);
        $this->programReportRepository = $programReportRepository;
    }

    /**
     * @OA\Get(
     *     path="/api/reports",
     *     tags={"ProgramReports"},
     *     summary="Get Program Reports",
     *     description="Get Program Reports as Array",
     *     operationId="index",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200,description="Get Program Reports as Array"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports"),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->programReportRepository->getAll();
            return $this->responseSuccess($data, 'Program Reports Results!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/reports/view/all",
     *     tags={"ProgramReports"},
     *     summary="All Program Reports - Publicly Accessible",
     *     description="All Program Reports - Publicly Accessible",
     *     operationId="indexAll",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="All Program Reports - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports/view/all"),
     * )
     */
    public function indexAll(Request $request): JsonResponse
    {
        try {
            $data = $this->programReportRepository->getPaginatedData($request->perPage);
            return $this->responseSuccess($data, 'Program Reports Results!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/reports/view/search",
     *     tags={"ProgramReports"},
     *     summary="All Program Reports - Publicly Accessible",
     *     description="All Program Reports - Publicly Accessible",
     *     operationId="search",
     *     @OA\Parameter(name="perPage", description="perPage, eg; 20", example=20, in="query", @OA\Schema(type="integer")),
     *     @OA\Parameter(name="search", description="search, eg; Test", example="Test", in="query", @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="All Program Reports - Publicly Accessible" ),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports/view/search"),
     * )
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $data = $this->programReportRepository->searchProgramReport($request->search, $request->perPage);
            return $this->responseSuccess($data, 'Program Reports Results!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\POST(
     *     path="/api/reports",
     *     tags={"ProgramReports"},
     *     summary="Create A New Program Report",
     *     description="Create A New Program Report",
     *     operationId="store",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Program 1"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="severity", type="integer", example=1),
     *              @OA\Property(property="request_status", type="integer", example=1),
     *              @OA\Property(property="program_id", type="integer", example=1),
     *          ),
     *      ),
     *      security={{"bearer":{}}},
     *      @OA\Response(response=200, description="Create a New Program Report" ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports"),
     * )
     */
    public function store(ProgramReportRequest $request): JsonResponse
    {
        try {
            $programReport = $this->programReportRepository->create($request->all());
            return $this->responseSuccess($programReport, 'New Program Created!');
        } catch (\Exception $exception) {
            return $this->responseError(null, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/reports/{id}",
     *     tags={"ProgramReports"},
     *     summary="Show Program Report Details",
     *     description="Show Program Report Details",
     *     operationId="show",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Show Programs Details"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports/{id}"),
     * )
     */
    public function show($id): JsonResponse
    {
        try {
            $data = $this->programReportRepository->getByID($id);
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
     *     path="/api/reports/{id}",
     *     tags={"ProgramReports"},
     *     summary="Update A Program Report",
     *     description="Update A Program Report",
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="title", type="string", example="Program Report 1"),
     *              @OA\Property(property="description", type="string", example="Description"),
     *              @OA\Property(property="severity", type="integer", example=1),
     *              @OA\Property(property="request_status", type="integer", example=1),
     *              @OA\Property(property="program_id", type="integer", example=1),
     *          ),
     *      ),
     *     operationId="update",
     *     security={{"bearer":{}}},
     *     @OA\Response(response=200, description="Update A Program"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports/{id}"),
     * )
     */
    public function update(ProgramReportRequest $request, $id): JsonResponse
    {
        try {
            $data = $this->programReportRepository->update($id, $request->all());
            if (is_null($data))
                return $this->responseError(null, 'Program Not Found', Response::HTTP_NOT_FOUND);

            return $this->responseSuccess($data, 'Program Updated Successfully!');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\DELETE(
     *     path="/api/reports/{id}",
     *     tags={"ProgramReports"},
     *     summary="Delete A Program Report",
     *     description="Delete A Program Report",
     *     operationId="destroy",
     *     security={{"bearer":{}}},
     *     @OA\Parameter(name="id", description="id, eg; 1", required=true, in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Delete A Program"),
     *     @OA\Response(response=400, description="Bad request"),
     *     @OA\Response(response=404, description="Resource Not Found"),
     *     @OA\PathItem (path="/api/reports/{id}"),
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $programReport =  $this->programReportRepository->getByID($id);
            if (empty($programReport)) {
                return $this->responseError(null, 'Program Not Found', Response::HTTP_NOT_FOUND);
            }

            $deleted = $this->programReportRepository->delete($id);
            if (!$deleted) {
                return $this->responseError(null, 'Failed to delete the program.', Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->responseSuccess($programReport, 'Program Deleted Successfully !');
        } catch (\Exception $e) {
            return $this->responseError(null, $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
