<?php


namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\API\Company_Department;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Designation extends Model
{
   // use HasFactory;
   use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_designation';
    protected $primarykey="_id";
    public $timestamps = true;
   
    protected $fillable = [
        '_token', 
        'designation_name', 
        'department_id',
        'delete_status',
    ];
   
  
    public function up()
    {
        Schema::create('company_designation', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('designation_name');
            $collection->string('department_id');
            $collection->string('delete_status');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_designation');
    }
    public function department()
    {
        return $this->belongsTo(Company_Department::class, 'department_id');
    }
}



