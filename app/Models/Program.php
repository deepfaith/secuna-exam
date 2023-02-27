<?php

namespace App\Models;

use App\Constants\DirectoryConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
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
        'pentesting_start_date',
        'pentesting_end_date',
        'image',
        'user_id',
        'record_status'
    ];

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

    /**
     * Programs Reports
     *
     * Get All program reports by program
     *
     * @return object Eloquent program report object
     */
    public function programReports()
    {
        return $this->hasMany(ProgramReport::class)->orderBy('id', 'desc');
    }

    // Add New Attribute to get image address
    protected $appends = ['image_url'];

    /**
     * Get Added Image Attribute URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): string | null
    {
        if (is_null($this->image) || $this->image === "") {
            return null;
        }

        return url('') . DirectoryConstants::PATH['programs'] . $this->image;
    }
}
