<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\Times\GetService;
use \App\Domain\Services\Times\TimesServiceInterface;

/**
 * Class TimesController
 * @package App\Http\Controllers
 */
class TimesController extends Controller
{
    /**
     * @var TimesServiceInterface
     */
    private TimesServiceInterface $service;

    /**
     * TimesController constructor.
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
        return view('times.list', ['times' => $service()]);
   }
}
