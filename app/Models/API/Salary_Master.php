<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;

class Salary_Master extends Model
{
    use HasApiTokens;

    protected $connection = 'mongodb';
    protected $collection = 'salary_master';

    protected $fillable = [
        '_id',
        'company_id',
        'department_id',
        'type_id'
    ];
    use HasFactory;
}
