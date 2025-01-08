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
 * Class Jurnal
 * 
 * @property string $id_jurnal
 * @property string $id_anak_pkl
 * @property string $id_mentor
 * @property string $aktifitas
 * @property Carbon $tanggal_jurnal
 * @property Carbon $waktu_mulai_aktifitas
 * @property Carbon $waktu_selesai_aktifitas
 * @property int $durasi
 * @property string $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnakPkl $anak_pkl
 * @property Mentor $mentor
 * @property Collection|Feedback[] $feedback
 *
 * @package App\Models
 */
class Jurnal extends Model
{
	use HasUlids;

	protected $table = 'jurnal';
	protected $primaryKey = 'id_jurnal';
	public $incrementing = false;
	protected $appends = ['durasi_format'];

	protected $casts = [
		'tanggal_jurnal' => 'datetime',
		'waktu_mulai_aktifitas' => 'datetime',
		'waktu_selesai_aktifitas' => 'datetime',
		'durasi' => 'int'
	];

	protected $fillable = [
		'id_anak_pkl',
		'id_mentor',
		'aktifitas',
		'tanggal_jurnal',
		'waktu_mulai_aktifitas',
		'waktu_selesai_aktifitas',
		'durasi',
		'keterangan'
	];

	public function resolveRouteBinding($value, $field = null)
	{
		return $this->where($this->primaryKey, $value)->first();
	}

	public function anak_pkl()
	{
		return $this->belongsTo(AnakPkl::class, 'id_anak_pkl');
	}

	public function mentor()
	{
		return $this->belongsTo(Mentor::class, 'id_mentor');
	}

	public function feedback()
	{
		return $this->hasMany(Feedback::class, 'id_jurnal');
	}

	public function getDurasiFormatAttribute()
	{
		$hours = floor($this->durasi / 3600);
		$minutes = floor(($this->durasi % 3600) / 60);
		$seconds = $this->durasi % 60;

		return "{$hours} jam {$minutes} menit {$seconds} detik";
	}
}
