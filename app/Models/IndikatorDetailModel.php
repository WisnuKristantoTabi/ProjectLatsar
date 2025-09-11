<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BidangModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PenilaianModel;
use App\Models\IndikatorModel;
use Illuminate\Support\Str;

class IndikatorDetailModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'indikator_detail';

    protected $primaryKey = 'indikator_detail_id';
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
            if (empty($model->indikator_detail_id)) {
                $model->indikator_detail_id = (string) Str::ulid();
            }
        });
    }

    protected $fillable = [
        'indikator_id',
        'kegiatan_name',
        'keterangan',
        'realisasi_anggaran',
        'bidang_id',
        'triwulan',
        'usulan_kegiatan_name',
        'target_per',
        'target_per_jenis',
        'realisasi_kegiatan_name'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    public function penilaian(): HasMany
    {
        return $this->hasMany(PenilaianModel::class, 'indikator_detail_id');
    }

    public function indikator(): BelongsTo
    {
        return $this->belongsTo(IndikatorModel::class, 'indikator_id');
    }
}
