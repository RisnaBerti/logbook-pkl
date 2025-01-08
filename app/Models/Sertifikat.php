<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class Sertifikat
 * 
 * @property string $id_sertifikat
 * @property string $id_anak_pkl
 * @property string $judul_sertifikat
 * @property string $nama_pengesah
 * @property Carbon $tanggal_sertifikat
 * @property string $keterangan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnakPkl $anak_pkl
 *
 * @package App\Models
 */
class Sertifikat extends Model
{
	use HasUlids;

	protected $table = 'sertifikat';
	protected $primaryKey = 'id_sertifikat';
	public $incrementing = false;

	protected $casts = [
		'tanggal_sertifikat' => 'datetime'
	];

	protected $fillable = [
		'id_anak_pkl',
		'judul_sertifikat',
		'nama_pengesah',
		'tanggal_sertifikat',
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
}
