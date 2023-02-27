<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramReport extends Model
{
    use HasFactory;

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'severity',
        'record_status',
        'request_status',
        'user_id',
        'program_id'
    ];

    /**
     * Program
     *
     * Get Program Uploaded By ProgramReport
     *
     * @return object
     */
    public function program(): object
    {
        return $this->belongsTo(Program::class)->select('id', 'title', 'description');
    }

    /**
     * User
     *
     * Get User Uploaded By Program
     *
     * @return object
     */
    public function user(): object
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }
}
