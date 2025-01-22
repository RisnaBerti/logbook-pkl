<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class DetailMentoring
 * 
 * @property string $id_detail_mentoring
 * @property string $id_riwayat_mentoring
 * @property string $id_anak_pkl
 * @property string $id_mentor
 * @property int|null $hari_mentor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnakPkl $anak_pkl
 * @property Mentor $mentor
 * @property RiwayatMentoring $riwayat_mentoring
 *
 * @package App\Models
 */
class DetailMentoring extends Model
{
	use HasUlids;

	protected $table = 'detail_mentoring';
	protected $primaryKey = 'id_detail_mentoring';
	public $incrementing = false;

	protected $casts = [
		'hari_mentor' => 'int'
	];

	protected $fillable = [
		'id_riwayat_mentoring',
		'id_anak_pkl',
		'id_mentor',
		'hari_mentor'
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

	public function riwayat_mentoring()
	{
		return $this->belongsTo(RiwayatMentoring::class, 'id_riwayat_mentoring');
	}
}
