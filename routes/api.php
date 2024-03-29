<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\Image\ImageController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\QrCode\QrCodeController;
use App\Http\Controllers\Api\V1\ConsumptionController;
use App\Http\Controllers\Api\V1\Order\OrderController;
use App\Http\Controllers\Api\Pincode\PincodeController;
use App\Http\Controllers\Api\V1\Order\BasketController;
use App\Http\Controllers\Api\V1\Price\CashierController;
use App\Http\Controllers\Api\V1\Price\PaymentController;
use App\Http\Controllers\Api\V1\Price\CurrencyController;
use App\Http\Controllers\Api\Excel\ProductExcelController;
use App\Http\Controllers\Api\V1\Employee\SalaryController;
use App\Http\Controllers\Api\V1\Order\StatisticaController;
use App\Http\Controllers\Api\V1\Employee\EmployeeController;
use App\Http\Controllers\Api\V1\Order\ReturnOrderController;
use App\Http\Controllers\Api\Ingredient\IngredientController;
use App\Http\Controllers\Api\Ingredient\ProductionController;
use App\Http\Controllers\Api\V1\Warehouse\WarehouseController;
use App\Http\Controllers\Api\V1\Warehouse\ReturnProductController;
use App\Http\Controllers\Api\Ingredient\IngredientProductController;
use App\Http\Controllers\Api\V1\Warehouse\WarehouseDefectController;
use App\Http\Controllers\Api\Ingredient\IngredientWarehouseController;

Route::post('/login', [EmployeeController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/register/client', [UserController::class, 'register']);
    Route::patch('/update/client', [UserController::class, 'update']);
    Route::get('/clients', [UserController::class, 'index']);
    Route::post('/register/admin', [EmployeeController::class, 'register']);
    //category
    Route::post('/category', [CategoryController::class, 'create']);
    Route::delete('/category/{id}', [CategoryController::class, 'delete']);
    Route::patch('/category', [CategoryController::class, 'update']);
    Route::get('/categories', [CategoryController::class, 'index']);
    //product
    Route::get('/products/ingredient', [ProductionController::class, 'products']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products/export', [ProductExcelController::class, 'export']);
    Route::post('/products/import', [ProductExcelController::class, 'import']);
    Route::prefix('/product')
        ->controller(ProductController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::put('/', 'update');
            Route::delete('/{id}', 'delete');
        });

    Route::prefix('/ingredients')
        ->controller(IngredientController::class)
        ->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::put('/{ingredient}', 'update');
            Route::delete('/{ingredient}', 'delete');
        });

    Route::prefix('/ingredient/product')
        ->controller(IngredientProductController::class)
        ->group(function () {
            Route::get('/{product}', 'index');
            Route::post('/', 'create');
            Route::delete('/position/{position}', 'delete');
        });

    Route::prefix('/ingredients/warehouses')
        ->controller(IngredientWarehouseController::class)
        ->group(function () {
            Route::post('/', 'create');
            Route::get('/', 'index');
            Route::get('/histories', 'histories');
        });
    Route::prefix('/company')
        ->controller(CompanyController::class)
        ->group(function () {
            Route::get('/', 'show');
            Route::patch('/', 'Update');
        });
    Route::post('/production', [ProductionController::class, 'Production']);
    Route::post('/production/calculator', [ProductionController::class, 'calculator']);
    Route::post('/production/create', [ProductionController::class, 'createBasket']);
    Route::get('/production/baskets', [ProductionController::class, 'baskets']);
    Route::get('/production/histories', [ProductionController::class, 'histories']);
    Route::get('/production/orders/{basket}', [ProductionController::class, 'orders']);
    Route::post('/production/finshed/{basket}', [ProductionController::class, 'finshed']);

    Route::get('/currency', [CurrencyController::class, 'index']);
    Route::post('/currency', [CurrencyController::class, 'setCurrency']);
    Route::post('/warehouse', [WarehouseController::class, 'create']);
    Route::get('/warehouse', [WarehouseController::class, 'index']);
    Route::get('/warehouse/cost-price', [WarehouseController::class, 'costprice']);
    Route::post('/warehouse/return', [ReturnProductController::class, 'returnProduct']);
    Route::get('/warehouse/return/history', [ReturnProductController::class, 'show']);
    Route::get('/warehouse/low-products', [WarehouseController::class, 'less']);
    Route::post('/warehouse/defect', [WarehouseDefectController::class, 'Defect']);
    Route::get('/warehouse/defect', [WarehouseDefectController::class, 'ShowDefects']);

    Route::post('/order', [OrderController::class, 'create']);
    Route::get('/baskets', [BasketController::class, 'index']);
    Route::get('/orders', [BasketController::class, 'basketOrders']);
    Route::get('/cashier', [CashierController::class, 'cashier']);
    Route::get('/cashier/monthly', [CashierController::class, 'monthly']);
    Route::get('/consumption/categories', [ConsumptionController::class, 'Categories']);
    Route::post('/consumption', [ConsumptionController::class, 'create']);
    Route::get('/consumptions', [ConsumptionController::class, 'index']);
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::patch('/employee/update', [EmployeeController::class, 'update']);
    Route::post('/salary', [SalaryController::class, 'setSalary']);
    Route::get('/salary/employee', [SalaryController::class, 'show']);
    Route::get('/salary/monthly/employee/', [SalaryController::class, 'monthly']);
    Route::post('/payment/basket/', [PaymentController::class, 'paidDebt']);
    Route::post('/payment/history/', [PaymentController::class, 'index']);
    Route::get('/pincode/generate', [PincodeController::class, 'generate']);
    Route::get('/statistica/product', [StatisticaController::class, 'index']);
    Route::get('/qrcode/read', [QrCodeController::class, 'code']);
    Route::post('/image/upload', [ImageController::class, 'upload']);
    Route::post('/return/orders', [ReturnOrderController::class, 'orders']);
});
Route::get('/qrcode/', [QrCodeController::class, 'generate'])->name('qrcode');
