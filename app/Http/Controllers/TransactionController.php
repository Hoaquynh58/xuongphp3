<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Hiển thị giao diện quản lý phiên giao dịch
    public function index()
    {
        $transaction = session('transaction');
        return view('transactions.index', compact('transaction'));
    }

    // Khởi tạo phiên giao dịch mới
    public function initiate(Request $request)
    {
        $transactionData = [
            'amount' => $request->input('amount'),
            'recipient_account' => $request->input('recipient_account'),
            'status' => 'pending',
            'steps_completed' => [],
        ];

        session(['transaction' => $transactionData]);

        return redirect()->route('transactions.index')->with('success', 'Transaction initiated!');
    }

    // Hiển thị form cập nhật giao dịch
    public function showUpdateForm()
    {
        $transaction = session('transaction');

        if ($transaction) {
            return view('transactions.update', compact('transaction'));
        }

        return redirect()->route('transactions.index')->with('error', 'Không tìm thấy giao dịch đang hoạt động!');
    }

    // Cập nhật trạng thái phiên giao dịch
    public function updateStatus(Request $request)
    {
        $transaction = session('transaction');

        if ($transaction) {
            $transaction['status'] = $request->input('status');
            session(['transaction' => $transaction]);

            return redirect()->route('transactions.index')->with('success', 'Đã cập nhật trạng thái giao dịch!');
        }

        return redirect()->route('transactions.index')->with('error', 'Không tìm thấy giao dịch đang hoạt động!');
    }

    // Hoàn tất phiên giao dịch
    public function complete()
    {
        $transaction = session('transaction');

        if ($transaction && $transaction['status'] === 'pending') {
            $transaction['status'] = 'completed';
            session(['transaction' => $transaction]);

            session()->forget('transaction');

            return redirect()->route('transactions.index')->with('success', 'Giao dịch đã hoàn tất!');
        }

        return redirect()->route('transactions.index')->with('error', 'Không có giao dịch đang hoạt động nào để hoàn tất!');
    }

    // Hủy phiên giao dịch
    public function cancel()
    {
        if (session()->has('transaction')) {
            session()->forget('transaction');
            return redirect()->route('transactions.index')->with('success', 'Hủy giao dịch thành công!');
        }

        return redirect()->route('transactions.index')->with('error', 'Không có giao dịch đang hoạt động để hủy!');
    }
}
