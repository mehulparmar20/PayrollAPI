<?php

namespace App\Models\API;

use MongoDB\Laravel\Eloquent\Model;

// use MongoDB\Laravel\Eloquent\Model;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Jenssegers\Mongodb\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;


class Company_admin extends Model
{
    // use HasFactory;
    protected $connection = 'mongodb';
    // protected $collection = 'company_admin';

    public function up()
    {
        Schema::create('company_admin', function (Blueprint $collection) {
            $collection->index('company_name');
            $collection->string('company_address');
            $collection->string('admin_name');
            $collection->string('admin_contact');
            $collection->string('company_email')->unique();
            $collection->string('admin_username');
            $collection->string('admin_password');
            $collection->string('total_employee');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_admin');
    }
}
