<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Algorithm\AlgorithmEnum;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Contracts\View\View;

final class MainController
{
    /**
     * @var ViewFactory
     */
    private $viewFactory;

    /**
     * MainController constructor.
     * @param ViewFactory $viewFactory
     */
    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * @return View
     */
    public function handle(): View
    {
        return $this->viewFactory->make('similarity', [
            'algorithms' => AlgorithmEnum::SELECT_ALGORITHMS,
            'special' => true,
            'preset' => AlgorithmEnum::ALL,
        ]);
    }
}