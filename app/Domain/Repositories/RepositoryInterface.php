<?php declare(strict_types=1);

namespace App\Domain\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface RepositoryInterface
 * @package App\Domain\Repositories
 */
interface RepositoryInterface
{
    /**
     * @return Model
     */
    public function getEntity(): Model;
}
