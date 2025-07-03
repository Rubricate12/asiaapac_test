<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'nomor',
        'nama',
        'jabatan',
        'talahir',
        'photo_upload_path',
        'photo_upload_url',
        'created_by',
        'updated_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'talahir' => 'date',
    ];

    const DELETED_AT = 'deleted_on';
}
