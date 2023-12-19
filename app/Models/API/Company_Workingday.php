<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Workingday extends Model
{
    //use HasFactory;
    use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'compnay_working_days';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'sunday',
        'monday', 
        'tuesday', 
        'wednesday', 
        'thursday', 
        'friday', 
        'saturday', 
        'monthly_allow_leave', 
        'delete_status',
    ];
    public function up()
    {
        Schema::create('compnay_working_days', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('sunday');
            $collection->string('monday');
            $collection->string('tuesday');
            $collection->string('wednesday');
            $collection->string('thursday');
            $collection->string('friday');
            $collection->string('saturday');
            $collection->string('monthly_allow_leave');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('compnay_working_days');
    }
}
