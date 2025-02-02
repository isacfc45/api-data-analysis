<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(protected SaleService $saleService) {}

    public function index(): JsonResponse
    {
        $sales = $this->saleService->getAllSales();
        return ApiResponse::success($sales, 'Sales retrieved successfully.', 200);
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = $this->saleService->createSale($request->validated());
        return ApiResponse::success($sale, 'Sale created successfully.', 201);
    }

    public function show(int $id): JsonResponse
    {
        $sale = $this->saleService->getSaleById($id);
        return ApiResponse::success($sale, 'Sale retrieved successfully.', 200);
    }

    public function update(UpdateSaleRequest $request, int $id): JsonResponse
    {
        $sale = $this->saleService->updateSale($id, $request->validated());
        return ApiResponse::success($sale, 'Sale updated successfully.', 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->saleService->deleteSale($id);
        return ApiResponse::success([], 'Sale deleted successfully.', 200);
    }
}
