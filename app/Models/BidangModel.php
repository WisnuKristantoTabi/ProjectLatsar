<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BidangModel extends Model
{

    protected $table = 'bidang';
    protected $primaryKey = 'bidang_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->bidang_id)) {
                $model->bidang_id = (string) Str::ulid();
            }
        });
    }

    protected $fillable = [
        'nama_bidang',
        'deskripsi',
    ];
}
