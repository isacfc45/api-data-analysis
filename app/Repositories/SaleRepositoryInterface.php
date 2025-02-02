<?php

namespace App\Repositories;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

interface SaleRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): Sale;
    public function create(array $data): Sale;
    public function update(int $id, array $data): Sale;
    public function delete(int $id): bool;
    public function getByPeriod(Carbon $startDate, Carbon $endDate): Collection;
}
