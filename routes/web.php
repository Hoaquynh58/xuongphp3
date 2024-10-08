<?php

use App\Http\Controllers\CustomerController;
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
});

Route::get('/movies', function () {
    return view('check18');
})->middleware('age.check');

// Route::middleware([FlagMiddleware::class])->group(function () {
    Route::resource('customers', CustomerController::class);


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
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

