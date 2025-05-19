<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students Fees</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: #1a202c;
      line-height: 1.6;
    }
    .container {
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      padding: 2.5rem;
      margin: 3rem auto;
      max-width: 1200px;
    }
    h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #2d3748;
      text-align: center;
      margin-bottom: 2rem;
    }
    .table {
      border-collapse: separate;
      border-spacing: 0;
      background: #ffffff;
      border-radius: 8px;
      overflow: hidden;
    }
    .table thead {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: #ffffff;
    }
    .table thead th {
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      padding: 1rem;
      font-size: 0.9rem;
    }
    .table tbody tr {
      transition: background-color 0.3s ease;
    }
    .table tbody tr:hover {
      background-color: #edf2ff;
    }
    .table td {
      padding: 1rem;
      vertical-align: middle;
      font-size: 0.95rem;
    }
    .btn-sm {
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
      border-radius: 6px;
      transition: all 0.2s ease;
      font-weight: 500;
    }
    .btn-success {
      background-color: #48bb78;
      border-color: #48bb78;
      box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
    }
    .btn-success:hover {
      background-color: #38a169;
      border-color: #38a169;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(72, 187, 120, 0.4);
    }
    .btn-info {
      background-color: #4299e1;
      border-color: #4299e1;
      box-shadow: 0 2px 8px rgba(66, 153, 225, 0.3);
    }
    .btn-info:hover {
      background-color: #3182ce;
      border-color: #3182ce;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(66, 153, 225, 0.4);
    }
    .btn-secondary.disabled {
      background-color: #a0aec0;
      border-color: #a0aec0;
      cursor: not-allowed;
      opacity: 0.7;
    }
    .no-fees {
      text-align: center;
      font-size: 1.1rem;
      color: #718096;
      background: #edf2f7;
      padding: 1.5rem;
      border-radius: 8px;
      margin: 1rem 0;
    }
    /* SweetAlert2 Custom Styling */
    .swal2-modern .swal2-popup {
      border-radius: 12px;
      font-family: 'Inter', sans-serif;
    }
    .swal2-modern .swal2-title {
      color: #2d3748;
      font-weight: 600;
    }
    .swal2-modern .swal2-confirm-button {
      background-color: #48bb78 !important;
      border-color: #48bb78 !important;
      box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3) !important;
    }
    .swal2-modern .swal2-confirm-button:hover {
      background-color: #38a169 !important;
      border-color: #38a169 !important;
    }
    .swal2-modern .swal2-cancel-button {
      background-color: #a0aec0 !important;
      border-color: #a0aec0 !important;
    }
    .swal2-modern .swal2-cancel-button:hover {
      background-color: #718096 !important;
      border-color: #718096 !important;
    }
    /* Responsive Design */
    @media (max-width: 768px) {
      .container {
        padding: 1.5rem;
        margin: 2remV .container {
          padding: 1.5rem;
          margin: 2rem 1rem;
        }
        h1 {
          font-size: 1.5rem;
        }
        .table thead th,
        .table td {
          font-size: 0.85rem;
          padding: 0.75rem;
        }
        .btn-sm {
          padding: 0.4rem 0.8rem;
          font-size: 0.8rem;
        }
      }
      @media (max-width: 576px) {
        .table {
          display: block;
          overflow-x: auto;
          white-space: nowrap;
        }
        .table thead th,
        .table td {
          font-size: 0.8rem;
          padding: 0.5rem;
        }
        .btn-sm {
          padding: 0.35rem 0.7rem;
          font-size: 0.75rem;
        }
        h1 {
          font-size: 1.25rem;
        }
    }
}
  </style>
</head>
<body>
<div class="container">
  <h1>Students Pending Fees</h1>

  @if($feesList->isEmpty())
    <p class="no-fees">No pending fees found.</p>
  @else
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Semester</th>
          <th>Amount</th>
          <th>End Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      @foreach($feesList as $item)
        @php
          $today     = \Carbon\Carbon::today();
          $startDate = \Carbon\Carbon::parse($item->start_date);
          $endDate   = \Carbon\Carbon::parse($item->end_date);
          $canPay    = $today->gte($startDate);
          $isPaid    = in_array($item->structure_id, $paidStructures);
        @endphp
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->semester_name }} Semester</td>
          <td>{{ number_format($item->total_amount, 2) }}</td>
          <td>{{ $endDate->format('Y-m-d') }}</td>
          <td>
            @if($isPaid)
              <a href="{{ route('invoice.download', $item->structure_id) }}"
                 class="btn btn-sm btn-info">
                Download Invoice
              </a>
            @else
              <form method="POST"
                    action="{{ route('fees.pay') }}"
                    class="pay-form d-inline">
                @csrf
                <input type="hidden" name="schedule_id" value="{{ $item->schedule_id }}">
                <input type="hidden" name="structure_id" value="{{ $item->structure_id }}">
                <button
                  type="button"
                  class="btn btn-sm {{ $canPay ? 'btn-success pay-btn' : 'btn-secondary disabled' }}"
                  data-canpay="{{ $canPay ? '1' : '0' }}"
                  {{ !$canPay ? 'disabled' : '' }}>
                  Pay Now
                </button>
              </form>
            @endif
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @endif
</div>

<script>

  document.querySelectorAll('.pay-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      if (this.dataset.canpay !== '1') return;
      const form = this.closest('.pay-form');
      Swal.fire({
        title: 'Do You Want To Pay?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, Pay',
        cancelButtonText: 'No',
        customClass: {
          popup: 'swal2-modern'
        }
      }).then(result => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });


  @if(session('success'))
    Swal.fire({
      title: 'Success',
      text: '{{ session('success') }}',
      icon: 'success',
      confirmButtonText: 'OK',
      customClass: {
        popup: 'swal2-modern'
      }
    });
  @endif
</script>
</body>
</html>