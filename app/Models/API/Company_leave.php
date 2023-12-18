<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_leave extends Model
{
   // use HasFactory;
   use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_leave_type';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'leave_type',
        'delete_status',
    ];
    public function up()
    {
        Schema::create('company_leave_type', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('leave_type');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_leave_type');
    }

}
