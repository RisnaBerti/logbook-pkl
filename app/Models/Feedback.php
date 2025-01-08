<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

/**
 * Class Feedback
 * 
 * @property string $id_feedback
 * @property string $id_anak_pkl
 * @property string $id_mentor
 * @property string $id_jurnal
 * @property Carbon $tanggal_feedback
 * @property string $isi_feedback
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AnakPkl $anak_pkl
 * @property Jurnal $jurnal
 * @property Mentor $mentor
 *
 * @package App\Models
 */
class Feedback extends Model
{
	use HasUlids;
	
	protected $table = 'feedback';
	protected $primaryKey = 'id_feedback';
	public $incrementing = false;

	protected $casts = [
		'tanggal_feedback' => 'datetime'
	];

	protected $fillable = [
		'id_anak_pkl',
		'id_mentor',
		'id_jurnal',
		'tanggal_feedback',
		'isi_feedback'
	];

	public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($this->primaryKey, $value)->first();
    }

	public function anak_pkl()
	{
		return $this->belongsTo(AnakPkl::class, 'id_anak_pkl');
	}

	public function jurnal()
	{
		return $this->belongsTo(Jurnal::class, 'id_jurnal');
	}

	public function mentor()
	{
		return $this->belongsTo(Mentor::class, 'id_mentor');
	}
}
