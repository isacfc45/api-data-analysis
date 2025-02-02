<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepositoryInterface;
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
}
