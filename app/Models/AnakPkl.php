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
 * Class AnakPkl
 * 
 * @property string $id_anak_pkl
 * @property string $id_sekolah
 * @property string $id_periode_pkl
 * @property string $id_mentor
 * @property string $nama_anak_pkl
 * @property string $no_telp_anak_pkl
 * @property string $email_anak_pkl
 * @property string|null $foto_anak_pkl
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Mentor $mentor
 * @property PeriodePkl $periode_pkl
 * @property Sekolah $sekolah
 * @property Collection|Feedback[] $feedback
 * @property Collection|Jurnal[] $jurnals
 * @property Collection|Penilaian[] $penilaians
 * @property Collection|Sertifikat[] $sertifikats
 *
 * @package App\Models
 */
class AnakPkl extends Model
{
	use HasUlids;

	protected $table = 'anak_pkl';
	protected $primaryKey = 'id_anak_pkl';
	public $incrementing = false;

	protected $fillable = [
		'id_sekolah',
		'id_periode_pkl',
		'id_mentor',
		'nama_anak_pkl',
		'no_telp_anak_pkl',
		'email_anak_pkl',
		'foto_anak_pkl',
		'status'
	];

	public function resolveRouteBinding($value, $field = null)
	{
		return $this->where($this->primaryKey, $value)->first();
	}

	public function mentor()
	{
		return $this->belongsTo(Mentor::class, 'id_mentor');
	}

	public function periode_pkl()
	{
		return $this->belongsTo(PeriodePkl::class, 'id_periode_pkl');
	}

	public function sekolah()
	{
		return $this->belongsTo(Sekolah::class, 'id_sekolah');
	}

	public function feedback()
	{
		return $this->hasMany(Feedback::class, 'id_anak_pkl');
	}

	public function jurnal()
	{
		return $this->hasMany(Jurnal::class, 'id_anak_pkl');
	}

	public function penilaian()
	{
		return $this->hasMany(Penilaian::class, 'id_anak_pkl');
	}

	public function sertifikat()
	{
		return $this->hasMany(Sertifikat::class, 'id_anak_pkl');
	}
}
