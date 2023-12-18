<?php
namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Time extends Model
{
    //use HasFactory;
    use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_time';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'shift_no',
        'company_start_time', 
        'company_end_time', 
        'company_break_time', 
        'company_break_fine', 
        'company_late_fine', 
        'timezone', 
        'delete_status',
    ];
    public function up()
    {
        Schema::create('company_time', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('shift_no');
            $collection->string('company_start_time');
            $collection->string('company_end_time');
            $collection->string('company_break_time');
            $collection->string('company_break_fine');
            $collection->string('company_late_fine');
            $collection->string('timezone');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_time');
    }
}
