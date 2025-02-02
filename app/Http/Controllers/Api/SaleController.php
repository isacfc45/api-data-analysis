<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SaleController extends Controller
{
    public function __construct(protected SaleService $saleService) {}

    /**
     * Listar todas as vendas.
     *
     * @group Vendas
     * Endpoint para listar todas as vendas com paginação.
     *
     * @queryParam per_page int Número de itens por página. Exemplo: 10
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "user_id": 1,
     *       "amount": 100.50,
     *       "product_name": "Product A",
     *       "date": "2023-10-01"
     *     }
     *   ],
     *   "links": {
     *     "first": "http://localhost:8000/api/sales?page=1",
     *     "last": "http://localhost:8000/api/sales?page=1",
     *     "prev": null,
     *     "next": null
     *   },
     *   "meta": {
     *     "current_page": 1,
     *     "from": 1,
     *     "last_page": 1,
     *     "path": "http://localhost:8000/api/sales",
     *     "per_page": 10,
     *     "to": 1,
     *     "total": 1
     *   }
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $sales = $this->saleService->getPaginatedSales($perPage);
        return response()->json(['sales' => $sales]);
    }

    /**
     * Criar uma nova venda.
     *
     * @group Vendas
     * Endpoint para criar uma nova venda.
     *
     * @bodyParam user_id int required ID do usuário. Exemplo: 1
     * @bodyParam amount float required Valor da venda. Exemplo: 100.50
     * @bodyParam product_name string required Nome do produto. Exemplo: Product A
     * @bodyParam date date required Data da venda. Exemplo: 2023-10-01
     * @response 201 {
     *   "sale": {
     *     "id": 1,
     *     "user_id": 1,
     *     "amount": 100.50,
     *     "product_name": "Product A",
     *     "date": "2023-10-01",
     *     "created_at": "2023-10-01T12:00:00.000000Z",
     *     "updated_at": "2023-10-01T12:00:00.000000Z"
     *   }
     * }
     */
    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = $this->saleService->createSale($request->validated());
        return response()->json(['sale' => $sale], 201);
    }

    /**
     * Exibir detalhes de uma venda.
     *
     * @group Vendas
     * Endpoint para exibir detalhes de uma venda específica.
     *
     * @urlParam id int required ID da venda. Exemplo: 1
     * @response {
     *   "sale": {
     *     "id": 1,
     *     "user_id": 1,
     *     "amount": 100.50,
     *     "product_name": "Product A",
     *     "date": "2023-10-01",
     *     "created_at": "2023-10-01T12:00:00.000000Z",
     *     "updated_at": "2023-10-01T12:00:00.000000Z"
     *   }
     * }
     */
    public function show(int $id): JsonResponse
    {
        $sale = $this->saleService->getSaleById($id);
        return response()->json(['sale' => $sale]);
    }

    /**
     * Atualizar uma venda.
     *
     * @group Vendas
     * Endpoint para atualizar uma venda existente.
     *
     * @urlParam id int required ID da venda. Exemplo: 1
     * @bodyParam amount float Valor da venda. Exemplo: 150.75
     * @bodyParam product_name string Nome do produto. Exemplo: Product B
     * @bodyParam date date Data da venda. Exemplo: 2023-10-02
     * @response {
     *   "sale": {
     *     "id": 1,
     *     "user_id": 1,
     *     "amount": 150.75,
     *     "product_name": "Product B",
     *     "date": "2023-10-02",
     *     "created_at": "2023-10-01T12:00:00.000000Z",
     *     "updated_at": "2023-10-02T12:00:00.000000Z"
     *   }
     * }
     */
    public function update(UpdateSaleRequest $request, int $id): JsonResponse
    {
        $sale = $this->saleService->updateSale($id, $request->validated());
        return response()->json(['sale' => $sale]);
    }

    /**
     * Excluir uma venda.
     *
     * @group Vendas
     * Endpoint para excluir uma venda.
     *
     * @urlParam id int required ID da venda. Exemplo: 1
     * @response {
     *   "message": "Sale deleted successfully"
     * }
     */
    public function destroy(int $id): JsonResponse
    {
        $this->saleService->deleteSale($id);
        return response()->json(['message' => 'Sale deleted successfully']);
    }

    /**
     * Total de vendas.
     *
     * @group Vendas
     * Endpoint para obter o total de vendas.
     *
     * @response {
     *   "total_sales": 1000.50
     * }
     */
    public function getTotalSales(): JsonResponse
    {
        $totalSales = $this->saleService->getTotalSales();
        return response()->json(['total_sales' => $totalSales]);
    }

    /**
     * Média de vendas por dia.
     *
     * @group Vendas
     * Endpoint para obter a média de vendas por dia.
     *
     * @response {
     *   "average_sales_per_day": 50.25
     * }
     */
    public function getAverageSalesPerDay(): JsonResponse
    {
        $averageSales = $this->saleService->getAverageSalesPerDay();
        return response()->json(['average_sales_per_day' => $averageSales]);
    }

    /**
     * Vendas por produto.
     *
     * @group Vendas
     * Endpoint para obter o total de vendas por produto.
     *
     * @response {
     *   "sales_by_product": {
     *     "Product A": 500.25,
     *     "Product B": 300.50
     *   }
     * }
     */
    public function getSalesByProduct(): JsonResponse
    {
        $salesByProduct = $this->saleService->getSalesByProduct();
        return response()->json(['sales_by_product' => $salesByProduct]);
    }

    /**
     * Vendas por período.
     *
     * @group Vendas
     * Endpoint para obter vendas em um período específico.
     *
     * @queryParam start_date date required Data de início. Exemplo: 2023-10-01
     * @queryParam end_date date required Data de término. Exemplo: 2023-10-31
     * @response {
     *   "sales": [
     *     {
     *       "id": 1,
     *       "user_id": 1,
     *       "amount": 100.50,
     *       "product_name": "Product A",
     *       "date": "2023-10-01"
     *     }
     *   ]
     * }
     */
    public function getSalesByPeriod(Request $request): JsonResponse
    {
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $sales = $this->saleService->getSalesByPeriod($startDate, $endDate);
        return response()->json(['sales' => $sales]);
    }
}
