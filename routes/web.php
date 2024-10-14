<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\FlagMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth.basic'); //hiển thị ngay đăng nhập trong welcome

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/movies', function () {
    return view('check18');
})->middleware('check.age');




// Route::middleware([FlagMiddleware::class])->group(function () {
Route::resource('customers', CustomerController::class);
// Route::resource('customers', CustomerController::class)->middleware('checkAdmin');



Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])
    ->name('customers.forceDestroy');

Route::get('keke', function () {
    return view('welcome');
})->withoutMiddleware('auth'); //bỏ qua Middleware auth
// });

// Route::get('login', function(){
//     echo 'Đây là trang login';
//     die();
// })->name('login');

//đăng kí đăng nhập
Route::post('/register', [AuthController::class, 'register'])->name('users.store');

//tài khoản
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Dành cho admin, chỉ admin có thể truy cập
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

// Dành cho nhân viên, chỉ admin và nhân viên có thể truy cập
Route::middleware(['role:staff'])->group(function () {
    Route::get('/orders', function () {
        return view('orders.index');
    });
});

// Dành cho khách hàng, chỉ admin và khách hàng có thể truy cập
Route::middleware(['role:customer'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.index');
    });
});


// Route::get('session', function () {
//     // dd(session());

//     //Chưa tồn tại
//     // session()->get('ahihi', '789');

//     //tồn tại
//     // session()->put('ahihi', 'xxxxx');


//     // session()->put('ahihi', [
//     //     'name' => 'kkkkk',
//     //     'email' => 'kkk@gmail.com'
//     // ]);

//     //ghi đè name
//     // session()->put('ahihi.name', '00000');

//     // return session()->get('ahihi', '789');


//     //cho 1 mảng
//     session()->put('orders', []);
//     [
//         101 => [
//             'name' => 'Sản phẩm 1',
//             'price' => 50000
//         ],
//         102 => [
//             'name' => 'Sản phẩm 2',
//             'price' => 22222
//         ]
//     ];

//     // => thành
//     session()->put('orders', []);
//     session()->put('orders.101', [
//         'name' => 'Sản phẩm 1',
//         'price' => 50000
//     ]);

//     session(['orders.102' => ['name' => 'Sản phẩm 2', 'price' => 22222] ]);

//     return session('orders');

//     // session()->forget('ahihi');
//     // session()->invalidate();


//     // session()->flash('kk', 'ok');

//     // return session()->all;
// });





//session
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');



//session
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/transactions/initiate', [TransactionController::class, 'initiate'])->name('transactions.initiate');
Route::get('/transactions/update', [TransactionController::class, 'showUpdateForm'])->name('transactions.updateForm');
Route::post('/transactions/update', [TransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
Route::post('/transactions/complete', [TransactionController::class, 'complete'])->name('transactions.complete');
Route::post('/transactions/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
