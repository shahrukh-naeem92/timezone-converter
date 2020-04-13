<?php declare(strict_types=1);

namespace App\Domain\Services\Times;

use App\Domain\Repositories\RepositoryInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;

/**
 * Class ConverterService
 * @package App\Domain\Services\Times
 */
class ConverterService implements TimesServiceInterface
{
    /**
     * @var Client|null
     */
    private ?Client $httpClient;

    /**
     * @var string|null
     */
    private ?string $userTimezone = null;

    /**
     * @var RepositoryInterface|null
     */
    private ?RepositoryInterface $repository;

    /**
     * ConverterService constructor.
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
     * @param string $time
     * @param string $sourceTimezone
     * @return array
     */
    public function __invoke(string $time, string $sourceTimezone): array
    {
        $userTimezone = $this->getUserTimeZone();
        if ($userTimezone) {
            $time = $this->convert($time, $sourceTimezone, $userTimezone);
        }

        return $time;
    }

    /**
     * @return string
     */
    private function getUserTimeZone(): string
    {
        if (!is_null($this->userTimezone)) {
            return $this->userTimezone;
        }

        $client = $this->getHttpClient();
        $response = $client->request('GET', getenv('GEO_IP_API'), ['ip' => $_SERVER['REMOTE_ADDR']]);
        $result = unserialize($response->getBody()->getContents());
        $this->userTimezone = $result['geoplugin_timezone'] ?? '';

        return $this->userTimezone;
    }

    /**
     * @param string $time
     * @param string $sourceTimezone
     * @param string $targetTimezone
     * @return array
     * @throws \Exception
     */
    private function convert(string $time, string $sourceTimezone, string $targetTimezone): array
    {
        date_default_timezone_set($sourceTimezone);

        $datetime = new \DateTime($time);
        $timezone = new \DateTimeZone($targetTimezone);
        $datetime->setTimezone($timezone);

        return [
            'time' => $datetime->format('H:i:s'),
            'timezone' => $targetTimezone
        ];
    }

    /**
     * @return Client
     */
    private function getHttpClient(): Client
    {
        return $this->httpClient ?? $this->httpClient = App::make(Client::class);
    }
}
