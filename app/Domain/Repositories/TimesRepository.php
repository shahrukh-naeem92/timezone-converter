<?php declare(strict_types=1);

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class TimesRepository
 * @package App\Domain\Repositories
 */
class TimesRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    private Model $entity;

    /**
     * TimesRepository constructor.
     * @param Model $timesEntity
     */
    public function __construct(Model $timesEntity)
    {
        $this->entity = $timesEntity;
    }

    /**
     * @return Model
     */
    public function getEntity(): Model
    {
        return $this->entity;
    }

    /**
     * @return Collection
     */
    public function getAllTimesWithTimezones(): Collection
    {
        return $this->getEntity()->with(['timezone'])->get();
    }
}
