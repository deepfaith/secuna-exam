<?php

namespace App\Repositories\V1;

use App\Abstracts\CrudAbstract;
use App\Constants\DateFormatConstants;
use App\Constants\DirectoryConstants;
use App\Constants\PaginateConstant;
use App\Constants\RecordStatusConstants;
use App\Helpers\UploadHelper;
use App\Http\Resources\ProgramResource;
use App\Http\Resources\ProgramResourceCollection;
use App\Models\Program;
use App\Models\User;
use App\Repositories\collections;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Str;

class ProgramRepository extends CrudAbstract
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
        $this->setModel(Program::class);
        $this->setModelResource(ProgramResource::class);
    }

    /**
     * Get All Programs.
     *
     *
     * @return collections Array of Program Collection
     */
    public function getAll(): ProgramResourceCollection|null
    {
        $perPage = isset($perPage) ? intval($perPage) : PaginateConstant::DEFAULT_LIMIT;
        $programs = $this->user->programs()
            ->where('record_status', RecordStatusConstants::STATUS[1]['value'])
            ->orderBy('id', 'desc')
            ->with('user')
            ->paginate($perPage);
        return new ProgramResourceCollection($programs);
    }

    /**
     * Get Paginated Program Records.
     *
     * @param int $pageNo
     * @return collections Array of Program Collection
     */
    public function getPaginatedData($perPage): ProgramResourceCollection|null
    {
        $perPage = isset($perPage) ? intval($perPage) : PaginateConstant::DEFAULT_LIMIT;
        $programs = $this->getModel()::orderBy('id', 'desc')
            ->where('record_status', RecordStatusConstants::STATUS[1]['value'])
            ->with('user')
            ->paginate($perPage);
        return new ProgramResourceCollection($programs);
    }

    /**
     * Get Searchable Program Records with Pagination.
     *
     * @param int $pageNo
     * @return collections Array of Program Collection
     */
    public function searchProgram($keyword, $perPage): ProgramResourceCollection|null
    {
        $perPage = isset($perPage) ? intval($perPage) : PaginateConstant::DEFAULT_LIMIT;

        $programs = $this->getModel()::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->where('record_status', RecordStatusConstants::STATUS[1]['value'])
            ->orderBy('id', 'desc')
            ->with('user')
            ->paginate($perPage);
        return new ProgramResourceCollection($programs);
    }

    /**
     * Create a New Program.
     *
     * @param array $data
     * @return object Program Object
     */
    public function create(array $data): ProgramResource|null
    {
        $data['pentesting_start_date'] = strtotime($data['start_date']);
        $data['pentesting_end_date'] = strtotime($data['end_date']);
        $titleShort      = Str::slug(substr($data['title'], 0, 20));
        $data['user_id'] = $this->user->id;

        if (!empty($data['image'])) {
            $data['image'] = UploadHelper::upload('image', $data['image'], $titleShort . '-' . time(), DirectoryConstants::PATH['programs']);
        }

        return new ProgramResource($this->getModel()::create($data));
    }

    /**
     * Delete a Program.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $program = $this->getModel()::find($id);
        if (empty($program)) {
            return false;
        }
        $inactive_param = RecordStatusConstants::QUERY['inactive'];

        $program->update($inactive_param);
        $program->programReports()
            ->update($inactive_param);
        return true;
    }

    /**
     * Get Program By ID.
     *
     * @param int $id
     * @return void
     */
    public function getByID(int $id): ProgramResource|null
    {
        $program = $this->getModel()::with('user')->find($id);
        return new ProgramResource($program);
    }

    /**
     * Update Program By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated Program Object
     */
    public function update(int $id, array $data): ProgramResource|null
    {
        $program = $this->getModel()::find($id);
        if (!empty($data['image'])) {
            $titleShort = Str::slug(substr($data['title'], 0, 20));
            $data['image'] = UploadHelper::update('image', $data['image'], $titleShort . '-' . time(), DirectoryConstants::PATH['programs'], $program->image);
        } else {
            $data['image'] = $program->image;
        }

        if (is_null($program)) {
            return null;
        }

        // If everything is OK, then update.
        $program->update($data);

        // Finally return the updated program.
        return new ProgramResource($this->getByID($program->id));
    }
}
