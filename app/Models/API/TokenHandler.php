<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TokenHandler extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'token_handler';

    // protected $fillable = [
    //     '_id',
    //     'company_name',
    //     'company_address',
    //     'admin_name',
    //     'admin_contact',
    //     'emailVerificationStatus',
    //     'company_email',
    //     'admin_username',
    //     'total_employee',
    //     'admin_password'
    // ];
    use HasFactory;
}
