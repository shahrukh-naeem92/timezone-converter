<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\Times\GetService;
use \App\Domain\Services\Times\TimesServiceInterface;

/**
 * Class ConvertedTimesController
 * @package App\Http\Controllers
 */
class ConvertedTimesController extends Controller
{
    /**
     * @var TimesServiceInterface
     */
    private TimesServiceInterface $service;

    /**
     * ConvertedTimesController constructor.
     * @param TimesServiceInterface $service
     */
    public function __construct(TimesServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke() {
        $service = $this->service;
        /* @var  $service GetService*/
        return view('times.converted-list', ['times' => $service(true)]);
   }
}
