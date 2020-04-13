<?php declare(strict_types=1);

namespace App\Domain\Services\Times;

use App\Domain\Repositories\RepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

/**
 * Class GetService
 * @package App\Domain\Services\Times
 */
class GetService implements TimesServiceInterface
{
    /**
     * @var RepositoryInterface|null
     */
    private ?RepositoryInterface $repository;

    /**
     * @var TimesServiceInterface|null
     */
    private ?TimesServiceInterface $converter;

    /**
     * GetService constructor.
     * @param RepositoryInterface|null $timesRepository
     */
    public function __construct(RepositoryInterface $timesRepository = null)
    {
        $this->repository = $timesRepository;
    }

    /**
     * @return RepositoryInterface|null
     */
    public function getRepository(): ?RepositoryInterface
    {
        return $this->repository;
    }

    /**
     * @param bool $convertToLocalTimeZone
     * @return array
     */
    public function __invoke(bool $convertToLocalTimeZone = false): array
    {
        return $this->reArrangeTimes($this->getRepository()->getAllTimesWithTimezones(), $convertToLocalTimeZone);
    }

    /**
     * @param Collection $collection
     * @param bool $convertToLocalTimeZone
     * @return array
     */
    private function reArrangeTimes(Collection $collection, bool $convertToLocalTimeZone): array
    {
        $times = [];
        foreach ($collection as $item) {
            $time['time'] = $item->time;
            $time['timezone'] = $item->timezone->name;
            if ($convertToLocalTimeZone) {
                $time = $this->converterService()($time['time'], $time['timezone']);
            }
            $times[] = $time;
        }

        return $times;
    }

    /**
     * @return TimesServiceInterface
     */
    private function converterService(): TimesServiceInterface
    {
        return $this->converter ?? $this->converter = App::make(ConverterService::class);
    }
}
