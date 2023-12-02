<?php


namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Department extends Model
{
    // use HasFactory;
    use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_department';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'department_name', 
        'delete_status',
    ];
    public function up()
    {
        Schema::create('company_department', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('department_name');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_department');
    }
}


