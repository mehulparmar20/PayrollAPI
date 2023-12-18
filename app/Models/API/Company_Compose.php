<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Company_Compose extends Model
{
   // use HasFactory;
   use HasApiTokens;
    protected $connection = 'mongodb';
    protected $collection = 'company_compose';
    public $timestamps = true;
    protected $fillable = [
        '_token', 
        'to',
        'subject',
        'message',
        'delete_status',
    ];
    public function up()
    {
        Schema::create('company_compose', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('to');
            $collection->string('subject');
            $collection->string('message');
            $collection->integer('delete_status');
            $collection->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('company_compose');
    }

}
