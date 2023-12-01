<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;

class Company_Announcement extends Model
{
    use HasApiTokens;

    protected $connection = 'mongodb';
    protected $collection = 'company_announcement';

    protected $fillable = [
        '_id',
        'company_id',
        'announcement_subject',
        'announcement_status',
        'announcement_body'
    ];
    use HasFactory;
}
