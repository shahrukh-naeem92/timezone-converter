<?php declare(strict_types=1);

namespace App\Domain\Services\Times;

use App\Domain\Repositories\RepositoryInterface;

/**
 * Interface TimesServiceInterface
 * @package App\Domain\Services\Times
 */
interface TimesServiceInterface
{
    /**
     * @return RepositoryInterface|null
     */
    public function getRepository(): ?RepositoryInterface;
}
