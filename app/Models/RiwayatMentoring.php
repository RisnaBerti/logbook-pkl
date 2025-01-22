<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class RiwayatMentoring
 * 
 * @property string $id_riwayat_mentoring
 * @property string $id_anak_pkl
 * @property string $id_mentor
 * @property Carbon $tanggal_mulai
 * @property Carbon $tanggal_akhir
 * @property int $hari_mentor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnakPkl $anak_pkl
 * @property Mentor $mentor
 *
 * @package App\Models
 */
class RiwayatMentoring extends Model
{
	use HasUlids;

	protected $table = 'riwayat_mentoring';
	protected $primaryKey = 'id_riwayat_mentoring';
	public $incrementing = false;

	protected $casts = [
		'tanggal_mulai' => 'datetime',
		'tanggal_akhir' => 'datetime',
	];

	protected $fillable = [
		'id_mentor',
		'tanggal_mulai',
		'tanggal_akhir'
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

	//relasi detail mentoring
	public function detail_mentoring()
	{
		return $this->hasMany(DetailMentoring::class, 'id_riwayat_mentoring');
	}
}
