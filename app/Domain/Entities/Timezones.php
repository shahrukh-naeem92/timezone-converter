<?php declare(strict_types=1);

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Timezones
 * @package App\Domain\Entities
 */
class Timezones extends Model
{
    /**
     * Get the times for a timezone
     */
    public function times()
    {
        return $this->hasMany('App\Domain\Entities\Times');
    }
}
