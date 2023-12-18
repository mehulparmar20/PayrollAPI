<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_EmployeeHistory extends Model
{
   // use HasFactory;
   use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_employeehistory';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'employee_name', 
        'joining_date',
        'status',
    ];
    public function up()
    {
        Schema::create('company_employeehistory', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('employee_name');
            $collection->string('joining_date');
            $collection->integer('status');
            $collection->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_employeehistory');
    }
}


