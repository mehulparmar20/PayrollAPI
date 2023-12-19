<?php
namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Branch extends Model
{
   // use HasFactory;
   use HasApiTokens;
   protected $connection = 'mongodb';
   protected $collection = 'company_branch';
   public $timestamps = true;
   protected $fillable = [
       '_token', 
       'branch_name',
       'address', 
       'phone', 
       'status',
   ];
   public function up()
   {
       Schema::create('company_branch', function (Blueprint $collection) {
           $collection->string('company_id');
           $collection->string('counter');
           $collection->string('branch_name');
           $collection->string('address');
           $collection->string('phone');
           $collection->integer('status');
           $collection->timestamps();
       });
   }
   public function down()
   {
       Schema::dropIfExists('company_branch');
   }
}
