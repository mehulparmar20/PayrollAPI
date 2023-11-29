<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

class Company_user extends Model
{
    // use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'company_user';
    protected $fillable = [
        '_token', 
        'user_email',
        'user_name', 
        'user_password',
        'user_type',
        'user_add_date',
       
    ];
    public function companyAdmin()
    {
        return $this->belongsTo(Company_admin::class,'_id'); // Assuming there is a field 'admin_id' in the 'company_user' collection referencing '_id' in 'company_admin' collection
    }
    

    public function up()
    {
        Schema::create('company_user', function (Blueprint $collection) {
            $collection->string('company_id');
            $collection->string('counter');
            $collection->string('user_email')->unique();
            $collection->string('user_name');
            $collection->string('user_password');
            $collection->string('user_type');
            $collection->date('user_add_date');
            $collection->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_user');
    }
}
