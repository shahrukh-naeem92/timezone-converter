<?php

namespace Tests\Unit\App\Domain\Services\Times;

use App\Domain\Services\Times\GetService;
use Illuminate\Support\Collection;
use App\Domain\Repositories\TimesRepository;
use Tests\TestCase;

/**
 * Class GetServiceTest
 * @package Tests\Unit\App\Domain\Services\Times
 */
class GetServiceTest extends TestCase
{
    /**
     * @dataProvider reArrangeTimesProvider
     * @param Collection $collection
     */
    public function testService(collection $collection, array $result)
    {
        $repo = $this->getMockBuilder(TimesRepository::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getAllTimesWithTimezones'])
            ->getMock();
        $repo->method('getAllTimesWithTimezones')
            ->willReturn($collection);

        $service = $this->getMockBuilder(GetService::class)
            ->onlyMethods(['getRepository'])
            ->getMock();
        $service->method('getRepository')
            ->willReturn($repo);

        $this->assertEquals($result, $service(false));
    }

    /**
     * @return array
     */
    public function reArrangeTimesProvider(): array
    {
        $time1 = new \stdClass();
        $time1->time = '10:00';
        $timezone1 = new \stdClass();
        $timezone1->name = 'Asia/Karachi';
        $time1->timezone = $timezone1;
        $time2 = new \stdClass();
        $time2->time = '14:00';
        $timezone2 = new \stdClass();
        $timezone2->name = 'Asia/Singapore';
        $time2->timezone = $timezone2;

        $collection1 = Collection::make([$time1, $time2]);
        $result1 = [
            [
                'time' => '10:00',
                'timezone' => 'Asia/Karachi'
            ],
            [
                'time' => '14:00',
                'timezone' => 'Asia/Singapore'
            ]
        ];

        $time3 = new \stdClass();
        $time3->time = '11:00';
        $timezone3 = new \stdClass();
        $timezone3->name = 'Asia/Malaysia';
        $time3->timezone = $timezone3;
        $time4 = new \stdClass();
        $time4->time = '13:00';
        $timezone4 = new \stdClass();
        $timezone4->name = 'Asia/Delhi';
        $time4->timezone = $timezone4;

        $collection2 = Collection::make([$time3, $time4]);
        $result2 = [
            [
                'time' => '11:00',
                'timezone' => 'Asia/Malaysia'
            ],
            [
                'time' => '13:00',
                'timezone' => 'Asia/Delhi'
            ]
        ];

        return [
            [
                $collection1,
                $result1
            ],
            [
                $collection2,
                $result2
            ]
        ];
    }
}
