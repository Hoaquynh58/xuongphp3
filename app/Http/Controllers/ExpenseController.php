<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(){
        $data = Expense::select(
            DB::raw('SUM(amount) as total_expenses'),
            DB::raw('EXTRACT(MONTH FROM expense_date) as month'),
            DB::raw('EXTRACT(YEAR FROM expense_date) as year')
        )
        ->groupBy(DB::raw('EXTRACT(MONTH FROM expense_date)'), DB::raw('EXTRACT(YEAR FROM expense_date)'))
        ->get();
        // dd($data);
        return view('expenses.index',compact('data'));
    }
}
