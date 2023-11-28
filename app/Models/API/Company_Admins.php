<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Company_Admins extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'company_admin';

    protected $fillable = [
        '_id',
        'company_name',
        'company_address',
        'admin_name',
        'admin_contact',
        'emailVerificationStatus',
        'company_email',
        'admin_username',
        'total_employee',
        'admin_password'
    ];
    use HasFactory;
}
