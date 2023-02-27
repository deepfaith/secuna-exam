<?php

namespace App\Abstracts;

use App\Constants\RecordStatusConstants;
use App\Interfaces\CrudInterface;
use App\Models\User;
use App\Traits\RepositoryTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

abstract class CrudAbstract implements CrudInterface
{
    use RepositoryTrait;

    /**
     * Authenticated User Instance.
     *
     * @var User
     */
    protected User | null $user;

    /**
     * Constructor.
     */
    public function __construct(){

        $this->user = Auth::guard()->user();
        $this->setModel(new User());
    }

    /**
     * Get All Data
     *
     * @return array All Data
     */
    abstract public function getAll();

    /**
     * Get Paginated Data
     *
     * @param int   Page No
     * @return array Paginated Data
     */
    abstract public function getPaginatedData(int $perPage);

    /**
     * Get Item Details By ID
     *
     * @param int $id
     * @return object Get Record
     */
    public function getByID(int $id)
    {
        return $this->getModel()::find($id);
    }


    /**
     * Create New Item
     *
     * @param array $data
     * @return object Created Record
     */
    public function create(array $data) {
        $data['user_id'] = $this->user->id;
        return $this->getModel()::create($data);
    }

    /**
     * Delete Item By Id / Updates the record_status column to inactive
     *
     * @param int $id
     * @return object Deleted Record
     */
    public function delete(int $id) {
        $record = $this->getByID($id);

        if (empty($record)) {
            return false;
        }

        $this->update($id, ['record_status' => RecordStatusConstants::STATUS['inactive']]);

        return true;
    }


    /**
     * Update Record By Id and Data
     *
     * @param int $id
     * @param array $data
     * @return object Updated Record
     */
    public function update(int $id, array $data) {
        $record = $this->getByID($id);

        if (is_null($record)) {
            return null;
        }

        // If everything is OK, then update.
        $record->update($data);

        // Finally return the updated record.
        return $this->getByID($record->id);
    }

    /**
     * Model to Resource
     * @return JsonResource
     */
    protected function toResource($records)
    {
        $resource = $this->getModelResource();
        return new $resource($records);
    }

}
