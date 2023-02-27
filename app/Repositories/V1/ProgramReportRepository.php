<?php

namespace App\Repositories\V1;

use App\Abstracts\CrudAbstract;
use App\Constants\PaginateConstant;
use App\Constants\RecordStatusConstants;
use App\Http\Resources\ProgramReportResource;
use App\Http\Resources\ProgramReportResourceCollection;
use App\Models\ProgramReport;
use App\Models\User;
use App\Repositories\collections;

class ProgramReportRepository extends CrudAbstract
{
    /**
     * Authenticated User Instance.
     *
     * @var User
     */
    public User | null $user;


    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setModel(ProgramReport::class);
    }

    /**
     * Get All ProgramReports.
     *
     * @return collections Array of ProgramReport Collection
     */
    public function getAll(): ProgramReportResourceCollection|null
    {
        $perPage = isset($perPage) ? intval($perPage) : PaginateConstant::DEFAULT_LIMIT;
        $programreports =  $this->user->programReports()
            ->where('record_status', RecordStatusConstants::STATUS[1]['value'])
            ->orderBy('id', 'desc')
            ->with(['user','program'])
            ->paginate($perPage);
        return new ProgramReportResourceCollection($programreports);
    }

    /**
     * Get Paginated ProgramReport Records.
     *
     * @param int $pageNo
     * @return collections Array of ProgramReport Collection
     */
    public function getPaginatedData($perPage): ProgramReportResourceCollection|null
    {
        $perPage = isset($perPage) ? intval($perPage) : PaginateConstant::DEFAULT_LIMIT;
        $programreports = $this->getModel()::orderBy('id', 'desc')
            ->where('record_status', RecordStatusConstants::STATUS[1]['value'])
            ->with(['user','program'])
            ->paginate($perPage);
        return new ProgramReportResourceCollection($programreports);
    }

    /**
     * Get Searchable ProgramReport Records with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of ProgramReport Collection
     */
    public function searchProgramReport($keyword, $perPage): ProgramReportResourceCollection|null
    {
        $perPage = isset($perPage) ? intval($perPage) : PaginateConstant::DEFAULT_LIMIT;
        $programreports = $this->getModel()::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->where('record_status', RecordStatusConstants::STATUS[1]['value'])
            ->orderBy('id', 'desc')
            ->with(['user','program'])
            ->paginate($perPage);
        return new ProgramReportResourceCollection($programreports);
    }

    /**
     * Get ProgramReport By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): ProgramReport|null
    {
        return $this->getModel()::with(['user','program'])->find($id);
    }

    /**
     * Update Program Report By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Program Object
     */
    public function update(int $id, array $data): ProgramReportResource|null
    {
        $programreport = $this->getModel()::find($id);

        if (is_null($programreport)) {
            return null;
        }

        if ($programreport->program_id != $data['program_id']) {
            return null;
        }


        // If everything is OK, then update.
        $programreport->update($data);

        // Finally return the updated program.
        return new ProgramReportResource($this->getByID($programreport->id));
    }

    /**
     * Create a New Program Report.
     *
     * @param array $data
     * @return object Program Report Object
     */
    public function create(array $data): ProgramReportResource|null
    {
        $data['user_id'] = $this->user->id;
        $data['record_status'] = RecordStatusConstants::STATUS[1]['value'];
        return new ProgramReportResource($this->getModel()::create($data));
    }

    /**
     * Delete a Program Report.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $programreport = $this->getModel()::find($id);
        if (empty($programreport)) {
            return false;
        }
        $inactive_param = RecordStatusConstants::QUERY['inactive'];

        $programreport->update($inactive_param);

        return true;
    }
}
