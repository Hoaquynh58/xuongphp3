<!DOCTYPE html>
<html>

<head>
    <title>Transaction Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Transaction Management</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif




        <!-- Form để khởi tạo phiên giao dịch -->
        <form method="POST" action="{{ route('transactions.initiate') }}">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>
            <div class="mb-3">
                <label for="recipient_account" class="form-label">Recipient Account</label>
                <input type="text" class="form-control" id="recipient_account" name="recipient_account" required>
            </div>
            <button type="submit" class="btn btn-primary">Initiate Transaction</button>
        </form>

        <hr>

        @if (session('transaction'))
            <p><strong>Amount:</strong> {{ session('transaction.amount') }}</p>
            <p><strong>Recipient Account:</strong> {{ session('transaction.recipient_account') }}</p>
            <p><strong>Status:</strong> {{ session('transaction.status') }}</p>

            <!-- Link để cập nhật giao dịch -->
            <a href="{{ route('transactions.updateForm') }}" class="btn btn-warning">Update Transaction</a>

            <form method="POST" action="{{ route('transactions.complete') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Complete Transaction</button>
            </form>

            <form method="POST" action="{{ route('transactions.cancel') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Cancel Transaction</button>
            </form>
        @endif
    </div>
</body>

</html>
