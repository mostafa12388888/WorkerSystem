<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{workerAuthController,AuthController,ClientAuthController};
use App\Http\Controllers\{PostCotroller,AdminDashbord\AdminNotificationController,
    AdminDashbord\postCptroller,Clinet\ClinetServicesController,
    WorkerReviewController,WorkerEXportAndImport,WorkerProfileController};
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::controller(workerAuthController::class)->prefix('worker')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/vefication/{token}', 'vefication');

});
Route::controller(WorkerProfileController::class)->middleware('auth:worker')->prefix('worker')->group(function () {
    Route::get('/UserProfile', 'UserProfile');
    Route::get('/edit', 'create');
    Route::get('/deletedAllposts', 'destroy');
    Route::post('/Updateposts', 'update');

});
Route::controller(WorkerEXportAndImport::class)->middleware('auth:worker')->prefix('worker')->group(function () {
    Route::get('/Export', 'Export_posts');
    Route::post('/Import', 'Import_posts');


});
Route::controller(PostCotroller::class)->prefix('Post')->group(function () {
    Route::post('/add', 'store');
    Route::get('/posts_aporved', 'approved');
    Route::get('/posts_filter', 'approvedFiltering');
});
Route::controller(postCptroller::class)->prefix('Post/change')->group(function () {
    Route::post('/change_status', 'update');
});
Route::controller(ClientAuthController::class)->prefix('client')->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
});
Route::controller(ClinetServicesController::class)->middleware('auth:clinet,worker')->prefix('client')->group(function () {
    Route::post('/add-order', 'addorderRequest');
    Route::get('/pending-order', 'index');
    Route::post('/update-order/{id}', 'update');
});
Route::controller(WorkerReviewController::class)->middleware('auth:clinet')->prefix('clientadworker')->group(function () {
    Route::post('/addReview', 'store');
    Route::get('/allReview', 'index');
    Route::get('/OneReview/{id}', 'show');

});
Route::controller(AdminNotificationController::class)->prefix('Admin/Notifiaction')->middleware("auth:admin")->group(function () {
    Route::get('/all', 'index');
    Route::get('/unread', 'unread');
    Route::get('/read-all', 'Read_All_Notifiaction');
    Route::post('/readone', 'Read_One_Notifiaction');
    Route::post('/delete-one', 'DeleteOne_Notifiaction');
    Route::get('/delete-all', 'DeleteAll_Notifiaction');
});
Storage::disk('Worker');
