<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SaleService
{
    public function __construct(protected SaleRepositoryInterface $saleRepository) {}

    public function getAllSales(): Collection
    {
        return $this->saleRepository->all();
    }

    public function createSale(array $data): Sale
    {
        Cache::forget('total_sales');
        Cache::forget('average_sales_per_day');
        return $this->saleRepository->create($data);
    }

    public function getSaleById(int $id): Sale
    {
        return $this->saleRepository->find($id);
    }

    public function updateSale(int $id, array $data): Sale
    {
        Cache::forget('total_sales');
        Cache::forget('average_sales_per_day');
        return $this->saleRepository->update($id, $data);
    }

    public function deleteSale(int $id): bool
    {
        Cache::forget('total_sales');
        Cache::forget('average_sales_per_day');
        return $this->saleRepository->delete($id);
    }

    public function getTotalSales(): float
    {
        return Cache::remember('total_sales', 3600, function () {
            return $this->saleRepository->all()->sum('amount');
        });
    }

    public function getAverageSalesPerDay(): float
    {
        return Cache::remember('average_sales_per_day', 3600, function () {
            $totalSales = $this->getTotalSales();
            $days = $this->saleRepository->all()->groupBy('date')->count();
            return $days > 0 ? $totalSales / $days : 0;
        });
    }

    public function getSalesByProduct(): array
    {
        return $this->saleRepository->all()
            ->groupBy('product_name')
            ->map(function ($sales) {
                return $sales->sum('amount');
            })
            ->toArray();
    }

    public function getSalesByPeriod(Carbon $startDate, Carbon $endDate)
    {
        return $this->saleRepository->getByPeriod($startDate, $endDate);
    }

    public function getPaginatedSales(int $perPage = 10)
    {
        return $this->saleRepository->paginate($perPage);
    }
}
