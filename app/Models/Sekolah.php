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
 * Class Sekolah
 * 
 * @property string $id_sekolah
 * @property string $nama_sekolah
 * @property string $alamat_sekolah
 * @property string $telepon_sekolah
 * @property string $email_sekolah
 * @property string|null $logo_sekolah
 * @property bool $status
 * @property string $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|AnakPkl[] $anak_pkls
 * @property Collection|PeriodePkl[] $periode_pkls
 *
 * @package App\Models
 */
class Sekolah extends Model
{
	use HasUlids;
	
	protected $table = 'sekolah';
	protected $primaryKey = 'id_sekolah';
	public $incrementing = false;

	protected $casts = [
		'status' => 'bool'
	];

	protected $fillable = [
		'nama_sekolah',
		'alamat_sekolah',
		'telepon_sekolah',
		'email_sekolah',
		'logo_sekolah',
		'status',
		'keterangan'
	];

	public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($this->primaryKey, $value)->first();
    }

	public function anak_pkl()
	{
		return $this->hasMany(AnakPkl::class, 'id_sekolah');
	}

	public function periode_pkl()
	{
		return $this->hasMany(PeriodePkl::class, 'id_sekolah');
	}
}
