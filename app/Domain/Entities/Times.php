<?php declare(strict_types=1);

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Times
 * @package App\Domain\Entities
 */
class Times extends Model
{
    /**
     * Get the timezone for a time
     */
    public function timezone()
    {
        return $this->belongsTo('App\Domain\Entities\Timezones', 'timezone_id', 'id');
    }
}
