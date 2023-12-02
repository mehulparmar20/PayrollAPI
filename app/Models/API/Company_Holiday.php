<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Holiday extends Model
{
    // use HasFactory;
    use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_holiday';
    protected $fillable = [
        '_token', 
        'holiday_name', 
        'holiday_date',
        'holiday_description',
        'delete_status',
    ];
    public function up()
    {
        Schema::create('company_holiday', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('holiday_name');
            $collection->date('holiday_date');
            $collection->string('holiday_description');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_holiday');
    }
}


