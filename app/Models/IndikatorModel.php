<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndikatorModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'indikator';
    protected $primaryKey = 'indikator_id';
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
            if (empty($model->indikator_id)) {
                $model->indikator_id = (string) Str::ulid();
            }
        });
    }

    protected $fillable = [
        'sasaran',
        'indikator_kinerja',
        'target',
        'target_jenis',
        'pagu_anggaran',
        'koreksi_normalisasi',

    ];
}
