<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Fees Details</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="no-print mb-3 text-end">
            <button class="btn btn-primary" id="printBtn">Print</button>
            <a href="{{ route('fees-details.list') }}" class="btn btn-secondary">Back</a>
        </div>

        <h3>Fees Details</h3>
        <p><strong>Course:</strong> {{ $feesStructure->course->course_name ?? 'N/A' }}</p>
        <p><strong>Academic Year:</strong> {{ $feesStructure->academicYear->academic_year ?? 'N/A' }}</p>
        <p><strong>Semester:</strong> {{ $feesStructure->semester->semester_no ?? 'N/A' }}</p>


        <h5 class="mt-4">Breakdown:</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fees Head</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feesStructure->feesDetails as $detail)
                    <tr>
                        <td>{{ $detail->feesHead->name ?? 'N/A' }}</td>
                        <td>{{ number_format($detail->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
                 <tr>
                    <td class="fw-bold text-end">Total Amount:</td>
                    <td class="fw-bold text-center">₹{{ number_format($feesStructure->total_amount, 2) }}</td>
                </tr>
        </table>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.getElementById('printBtn').addEventListener('click', function () {
            window.print();
        });
    </script>
</body>
</html>
