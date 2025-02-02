<?php

namespace App\Repositories;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SaleRepository implements SaleRepositoryInterface
{
    public function __construct(protected Sale $sale) {}

    public function all(): Collection
    {
        return $this->sale->all();
    }

    public function create(array $data): Sale
    {
        return $this->sale->create($data);
    }

    public function find(int $id): Sale
    {
        return $this->sale->findOrFail($id);
    }

    public function update(int $id, array $data): Sale
    {
        $sale = $this->find($id);
        $sale->update($data);

        return $sale;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }

    public function getByPeriod(Carbon $startDate, Carbon $endDate): Collection
    {
        return $this->sale->whereBetween('date', [$startDate, $endDate])->get();
    }

    public function paginate(int $perPage = 10)
    {
        return $this->sale->paginate($perPage);
    }
}
