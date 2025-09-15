<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'penilaian';
    protected $primaryKey = 'penilaian_id';
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
            if (empty($model->penilaian_id)) {
                $model->penilaian_id = (string) Str::ulid();
            }
        });
    }

    protected $fillable = [
        'indikator_id',
        'indikator_detail_id',
        'month',
        'year',
        'realisasi_kegiatan_score',
        'keterangan',
        'suppporting_data',
    ];
}
