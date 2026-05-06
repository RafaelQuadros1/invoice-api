<?php



use App\Http\Controllers\api\v1\InvoiceController;
use App\Http\Controllers\api\v1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/users',[UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/invoices',[InvoiceController::class, 'index']);

