<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    $users = DB::table('users')->get();
        // dd($users->toArray()) ;
    return view('welcome');
});

Route::get('/buoi1', function (){

    $b1 = DB::table('users as u')
    -> join('orders as o', 'u.id', '=', 'o.user_id')
    -> select('u.name', DB::raw('SUM(o.amount) as total_spent'))
    -> groupBy('u.name')
    -> having('total_spent', '>', '1000');

    // dd($b1->toRawSql());

    $b2 = DB::table('orders')
    ->select(DB::raw('DATE(order_date) as date'), DB::raw('COUNT(*) as orders_count'), DB::raw('SUM(total_amount) as total_sales'))
    ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
    ->groupBy(DB::raw('DATE(order_date)'));
    // dd($b2->toRawSql());


    $b3 = DB::table('products as p')
    ->select('p.product_name')
    -> whereNotExists(function($query){
        $query -> select(DB::raw(1))
               -> from('orders as o')
               ->whereColumn('o.product_id', 'p.id');
    });
    // dd($b3->toRawSql());

    $b4 = DB::table(DB::raw("(SELECT product_id, SUM(quantity) AS total_sold FROM sales GROUP BY product_id) AS sales_cte"))
    ->join('products as p', 'sales_cte.product_id', '=', 'p.id')
    ->select('p.product_name', 'sales_cte.total_sold')
    ->where('sales_cte.total_sold', '>', 100);
    // dd($b4->toRawSql());


    $b5 = DB::table('users as u')
    -> join('orders as o', 'u.id', '=', 'o.user_id')
    -> join('order_item as oi', 'o.id', '=', 'oi.oder_id')
    -> join('products as p', 'oi.product_id','=','p.id')
    -> select('u.name','p.product_name','o.order_date')
    -> where('o.order_date', '>=', DB::raw('NOW() - INTERVAL 30 DAY'));
    // dd($b5->toRawSql());

    $b6 = DB::table('orders as o')
    -> join('order_items as oi','o.id','=','oi.order_id')
    -> select(DB::raw("DATE_FORMAT(o.order_date),'%Y-%m' as order_month" ), DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'))
    -> where('o.status','completed')
    -> groupBy('order_month')
    -> orderBy('order_month', 'desc');
    // dd($b6->toRawSql());


    $b7 = DB::table('products as p')
    -> leftJoin('order_items as oi','p.id','=','oi.products_id')
    -> select('p.product_name')
    -> whereNull('oi.product_id');
    // dd($b7->toRawSql());

    $b8 = DB::table('products as p')
    -> join(DB::raw('(SELECT product_id, SUM(quantity * price) AS total FROM order_items GROUP BY product_id) as oi'), 'p.id', '=', 'oi.product_id')
    -> select('p.category_id', 'p.product_name', DB::raw('MAX(oi.total) as max_revenue'))
    -> groupBy('p.category_id', 'p.product_name')
    -> orderBy('max_revenue', 'desc');
    // dd($b8->toRawSql());


    $b9 = DB::table('orders as o')
    -> join('users as u', 'u.id', '=', 'o.user_id')
    -> join('order_items as oi', 'o.id', '=', 'oi.order_id')
    -> select('o.id', 'u.name', 'o.order_date', DB::raw('SUM(order_items.quantity * order_items.price) as total_value'))
    -> groupBy('o.id', 'u.name', 'o.order_date')
    -> havingRaw('total_value > (
        SELECT AVG(total) FROM (
            SELECT SUM(quantity * price) AS total FROM order_items GROUP BY order_id
        ) as avg_order_value
    )');
    // dd($b9->toRawSql());

    $b10 = DB::table('products as p')
    -> join('order_item as oi', 'p.id', '=', 'oi.product_id')
    -> select('p.category_id', 'p.product_name', DB::raw('SUM(oi.quantity) as total_sold'))
    -> groupBy('p.category_id', 'p.product_name')
    ->havingRaw('total_sold = (
        SELECT MAX(sub.total_sold)
        FROM (
            SELECT p.product_name, SUM(oi.quantity) AS total_sold
            FROM order_items as oi
            JOIN products as p ON p.product_id = oi.product_id
            WHERE p.category_id = p.category_id
            GROUP BY p.product_name
        ) as sub
    )');
    dd($b10->toRawSql());
});

Route::resource('sales',SaleController::class);
Route::resource('expenses',ExpenseController::class);
Route::resource('financial_reports',FinancialReportController::class);

