<?php
/**
 * Created by PhpStorm.
 * User: charlespalmer
 * Date: 2019-03-21
 * Time: 14:22
 */

namespace App\Services\Lists;

use App\Model\TradeWatchlist;
use App\Repositories\RepositoryInterface;
use App\Repositories\TradeDetails\TradeDetailsRepository;
use Illuminate\Support\Facades\App;

class ListService
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var TradeDetailsRepository
     */
    protected $tradeDetails;

    /**
     * ListService constructor.
     *
     * @param RepositoryInterface      $repository
     * @param RepositoryInterface|null $tradeDetails
     */
    public function __construct(RepositoryInterface $repository = null, RepositoryInterface $tradeDetails = null)
    {
        $this->repository = $repository;
        $this->tradeDetails = $tradeDetails;
    }

    /**
     * Get all the list items
     * @return mixed
     */
    public function getAll()
    {
        return $this->repository->all();
    }

    /**
     * Add a currency pair to a list from the homepage
     *
     * @param String $listType
     * @param Int    $pairId
     * @return TradeWatchlist
     */
    public function addFromHomepage($listType, $pairId)
    {
        switch($listType) {
            case 'watchlist':
                $service = app()->make('\App\Services\Lists\WatchlistService');
                break;
            case 'trades':
                $service = app()->make('\App\Services\Lists\ActiveListService');
                break;
            default:
                $service = app()->make('\App\Services\Lists\WatchlistService');
                break;
        }

        return $service->addCurrencyPair($pairId);
    }
}