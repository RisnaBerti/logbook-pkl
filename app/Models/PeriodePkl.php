<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class PeriodePkl
 * 
 * @property string $id_periode_pkl
 * @property string $id_sekolah
 * @property Carbon $tanggal_mulai
 * @property Carbon $tanggal_selesai
 * @property int $durasi_bulan
 * @property string $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Sekolah $sekolah
 * @property Collection|AnakPkl[] $anak_pkls
 *
 * @package App\Models
 */
class PeriodePkl extends Model
{
	use HasUlids;
	
	protected $table = 'periode_pkl';
	protected $primaryKey = 'id_periode_pkl';
	public $incrementing = false;

	protected $casts = [
		'tanggal_mulai' => 'date',
		'tanggal_selesai' => 'date',
		'durasi_bulan' => 'int'
	];

	protected $fillable = [
		'id_sekolah',
		'tanggal_mulai',
		'tanggal_selesai',
		'durasi_bulan',
		'keterangan'
	];

	public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($this->primaryKey, $value)->first();
    }

	public function sekolah()
	{
		return $this->belongsTo(Sekolah::class, 'id_sekolah');
	}

	public function anak_pkl()
	{
		return $this->hasMany(AnakPkl::class, 'id_periode_pkl');
	}
}
