<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Financial_report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialReportController extends Controller
{
    public function index()
    {
        
        $totalSales = DB::table('sales')
        ->whereMonth('sale_date', 9)
        ->whereYear('sale_date', 2024)
        ->sum('total');

        
        $totalExpenses = DB::table('expenses')
        ->whereMonth('expense_date', 9)
        ->whereYear('expense_date', 2024)
        ->sum('amount');

        
        $taxTotal = DB::table('taxes')
        ->where('tax_name', 'VAT')
        ->value('rate');

        $taxAmount = $totalSales * $taxTotal/100;
        // dd($taxAmount);

        $profitBeforeTax = $totalSales - $totalExpenses;
        // dd($profitBeforeTax);

        $profitAfterTax = $profitBeforeTax - $taxAmount;
        // dd($profitAfterTax);


        
        $data = Financial_report::query()->create([
            'month' => 9,
            'year' => 2024,
            'total_sales' => $totalSales,
            'total_expanse' => $totalExpenses,
            'profit_before_tax' => $profitBeforeTax,
            'tax_amount' => $taxAmount,
            'profit_after_tax' => $profitAfterTax
        ]);
        // dd($data);
        return view('FinancialReport.index', compact('data'));
    }
}
