<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class Penilaian
 * 
 * @property string $id_penilaian
 * @property string $id_anak_pkl
 * @property string $id_mentor
 * @property string $id_keterampilan
 * @property Carbon $tanggal_penilaian
 * @property int $nilai
 * @property string $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnakPkl $anak_pkl
 * @property Keterampilan $keterampilan
 * @property Mentor $mentor
 *
 * @package App\Models
 */
class Penilaian extends Model
{
	use HasUlids;

	protected $table = 'penilaian';
	protected $primaryKey = 'id_penilaian';
	public $incrementing = false;

	protected $casts = [
		'tanggal_penilaian' => 'datetime',
		'nilai' => 'int'
	];

	protected $fillable = [
		'id_mentor',
		'id_anak_pkl',
		'tanggal_penilaian',
		'nilai_rata_rata',
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

	public function detail()
	{
		return $this->hasMany(DetailPenilaian::class, 'id_penilaian', 'id_penilaian');
	}
}
