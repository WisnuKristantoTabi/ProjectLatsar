<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PenilaianModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'notifikasi_id';
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
            if (empty($model->notifikasi_id)) {
                $model->notifikasi_id = (string) Str::ulid();
            }
        });
    }

    protected $fillable = [
        'user_id',
        'jenis',
        'pesan',
        'status'
    ];
}
