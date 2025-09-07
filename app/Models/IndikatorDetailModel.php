<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BidangModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class IndikatorDetailModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'indikator_detail';

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';



    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->user_id)) {
                $model->user_id = (string) Str::ulid();
            }
        });
    }

    protected $fillable = [
        'nama',
        'username',
        'role',
        'bidang_id',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];
}
