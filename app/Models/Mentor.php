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
 * Class Mentor
 * 
 * @property string $id_mentor
 * @property string $nama_mentor
 * @property string $email_mentor
 * @property string $alamat_mentor
 * @property string $no_telp_mentor
 * @property string|null $foto_mentor
 * @property string $ttd_mentor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|AnakPkl[] $anak_pkls
 * @property Collection|Penilaian[] $penilaians
 *
 * @package App\Models
 */
class Mentor extends Model
{
	use HasUlids;
	
	protected $table = 'mentor';
	protected $primaryKey = 'id_mentor';
	public $incrementing = false;

	protected $fillable = [
		'nama_mentor',
		'email_mentor',
		'alamat_mentor',
		'no_telp_mentor',
		'foto_mentor',
		'ttd_mentor'
	];

	public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($this->primaryKey, $value)->first();
    }

	public function anak_pkl()
	{
		return $this->hasMany(AnakPkl::class, 'id_mentor');
	}

	public function penilaian()
	{
		return $this->hasMany(Penilaian::class, 'id_mentor');
	}
}
