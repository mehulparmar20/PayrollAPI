<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;

class Employee_Attendance extends Model
{
    use HasApiTokens;

    protected $connection = 'mongodb';
    protected $collection = 'employee_attendance';

    protected $fillable = [
        '_id',
        'company_id',
        'employee_id',
        'current_time'
    ];
    use HasFactory;
}
