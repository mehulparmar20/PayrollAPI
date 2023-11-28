<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MongoDB\Laravel\Eloquent\Model;//changes
class Plan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $connection = 'mongodb';
    protected $collection = 'table__plans';
    protected $fillable = [
        '_token', 
        'plan_name',
        'price', 
        'employee_no',
        'tax_id', 
        'description'
    ];
    // public function taxmaster()
    // {
    //     return $this->belongsTo(Taxmaster::class,'_id','tax_name');
    // }
    public function taxmaster()
    {
        return $this->belongsTo(Taxmaster::class, 'tax_id', '_id');
    }

}
