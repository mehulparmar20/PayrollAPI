<?php


namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Employee extends Model
{
    //use HasFactory;
    use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_employee';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'first_name',
        'last_name', 
        'email',
        'gender',
        'joining_date',
        'phone',
        'department',
        'designation',
        'salary',
        'shift',
        'delete_status',
    ];
   
}
