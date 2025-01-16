<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class DetailPenilaian
 * 
 * @property string $id_detail_penilaian
 * @property string $id_penilaian
 * @property string $id_keterampilan
 * @property float $nilai
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Keterampilan $keterampilan
 * @property Penilaian $penilaian
 *
 * @package App\Models
 */
class DetailPenilaian extends Model
{
	use HasUlids;

	protected $table = 'detail_penilaian';
	protected $primaryKey = 'id_detail_penilaian';
	public $incrementing = false;

	protected $casts = [
		'nilai' => 'float'
	];

	protected $fillable = [
		'id_penilaian',
		'id_keterampilan',
		'nilai'
	];

	public function resolveRouteBinding($value, $field = null)
	{
		return $this->where($this->primaryKey, $value)->first();
	}

	public function keterampilan()
	{
		return $this->belongsTo(Keterampilan::class, 'id_keterampilan');
	}

	public function penilaian()
	{
		return $this->belongsTo(Penilaian::class, 'id_penilaian', 'id_penilaian');
	}
}
