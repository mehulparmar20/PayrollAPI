<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Resignation extends Model
{
   // use HasFactory;
   use HasApiTokens;
   protected $connection = 'mongodb';
   protected $collection = 'company_resignation';
   public $timestamps = true;
   protected $fillable = [
       '_token', 
       'reason',
       'notice_date', 
       'resignation_date', 
       'employee_id', 
       'status',
   ];
   public function up()
   {
       Schema::create('company_resignation', function (Blueprint $collection) {
           $collection->string('company_id');
           $collection->string('counter');
           $collection->string('reason');
           $collection->string('notice_date');
           $collection->string('resignation_date');
           $collection->string('employee_id');
           $collection->integer('status');
           $collection->timestamps();
       });
   }
   public function down()
   {
       Schema::dropIfExists('company_resignation');
   }
}
