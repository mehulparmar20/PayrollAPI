<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;

class Employee_leave extends Model
{
    use HasApiTokens;

    protected $connection = 'mongodb';
    protected $collection = 'employee_leave';

    protected $fillable = [
        '_id',
        'company_id',
        'employee_id',
        'leave_type',
        'from_date',
        'to_date',
        'total_days',
        'remaining_leaves',
        'leave_reason'
    ];
    use HasFactory;
}
