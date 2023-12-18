<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Joining extends Model
{
    //use HasFactory;
    use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_joining_letter';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'manager_name',
        'manager_designation',
        'delete_status',
    ];
    public function up()
    {
        Schema::create('company_joining_letter', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('manager_name');
            $collection->string('manager_designation');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_joining_letter');
    }
}
