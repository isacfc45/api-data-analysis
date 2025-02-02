<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SaleService
{
    public function __construct(protected SaleRepositoryInterface $saleRepository) {}

    public function getAllSales(): Collection
    {
        return $this->saleRepository->all();
    }

    public function createSale(array $data): Sale
    {
        return $this->saleRepository->create($data);
    }

    public function getSaleById(int $id): Sale
    {
        return $this->saleRepository->find($id);
    }

    public function updateSale(int $id, array $data): Sale
    {
        return $this->saleRepository->update($id, $data);
    }

    public function deleteSale(int $id): bool
    {
        return $this->saleRepository->delete($id);
    }

    public function getTotalSales(): float
    {
        return $this->saleRepository->all()->sum('amount');
    }

    public function getAveregeSalesPerDay(): float
    {
        $totalSales = $this->getTotalSales();
        $days = $this->saleRepository->all()->groupBy('date')->count();
        return $days > 0 ? $totalSales / $days : 0;
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
}
