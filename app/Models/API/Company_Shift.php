<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;

class Company_Shift extends Model
{
    use HasApiTokens;

    protected $connection = 'mongodb';
    protected $collection = 'company_shift';

    protected $fillable = [
        '_id',
        'company_id',
        'shift',
        'shift_time'
    ];
    use HasFactory;
}
