<!DOCTYPE html>
<html>
<head>
    <title>Update Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Transaction</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(isset($transaction))
            <form method="POST" action="{{ route('transactions.updateStatus') }}">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="{{ $transaction['amount'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="recipient_account" class="form-label">Recipient Account</label>
                    <input type="text" class="form-control" id="recipient_account" name="recipient_account" value="{{ $transaction['recipient_account'] }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" {{ $transaction['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $transaction['status'] === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $transaction['status'] === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ $transaction['status'] === 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Status</button>
            </form>
        @else
            <p>No active transaction to update.</p>
        @endif

        <a href="{{ route('transactions.index') }}" class="btn btn-secondary mt-3">Back to Transactions</a>
    </div>
</body>
</html>
