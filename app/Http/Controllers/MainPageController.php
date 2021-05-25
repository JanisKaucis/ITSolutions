<?php

namespace App\Http\Controllers;

use App\Services\MainPageService;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    /**
     * @var MainPageService
     */
    private $mainPageService;

    public function __construct(MainPageService $mainPageService)
    {
        $this->mainPageService = $mainPageService;
    }

    public function mainPageShow() {
        $this->mainPageService->handlePageShow();
        return view('mainPage');
    }
    public function mainPageStore() {
        $this->mainPageService->handleOptionsSelect();
        return view('mainPage');
    }
}
