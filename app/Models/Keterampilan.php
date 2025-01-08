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
 * Class Keterampilan
 * 
 * @property string $id_keterampilan
 * @property string $nama_keterampilan
 * @property string $deskripsi_keterampilan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Penilaian[] $penilaians
 *
 * @package App\Models
 */
class Keterampilan extends Model
{
	use HasUlids;
	
	protected $table = 'keterampilan';
	protected $primaryKey = 'id_keterampilan';
	public $incrementing = false;

	protected $fillable = [
		'nama_keterampilan',
		'deskripsi_keterampilan'
	];

	public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($this->primaryKey, $value)->first();
    }

	public function penilaian()
	{
		return $this->hasMany(Penilaian::class, 'id_keterampilan');
	}
}
