<?php

namespace App\Http\Controllers;

use App\Services\CurrencyPairService;
use Illuminate\Http\Request;

class CurrencyPairsController extends Controller
{
    protected $service;

    /**
     * CurrencyPairsController constructor.
     * @param CurrencyPairService $service
     */
    public function __construct(CurrencyPairService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $currencyPairs = $this->service->getAllPairs();

        return view('pairs.index', ['currencyPairs' => $currencyPairs]);
    }
}
