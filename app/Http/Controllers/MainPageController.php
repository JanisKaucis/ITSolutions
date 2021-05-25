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
        $context = $this->mainPageService->getContext();
        return view('mainPage', $context);
    }
    public function mainPageStore() {
        $this->mainPageService->handleOptionsSelect();
        $this->mainPageService->deleteRow();
        return redirect()->route('main');
//        return view('mainPage');
    }
}
