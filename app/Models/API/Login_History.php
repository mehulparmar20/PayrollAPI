<?php

namespace App\Models\API;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Laravel\Sanctum\HasApiTokens;

class Login_History extends Model
{
    use HasApiTokens;

    protected $connection = 'mongodb';
    protected $collection = 'login_history';

    protected $fillable = [
        '_id',
        'company_id'
    ];
    use HasFactory;
}
