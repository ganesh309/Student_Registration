<!DOCTYPE html>
<html>
<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .container {
            width: 90%;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
        }
        .header {
            text-align: center;
            overflow: hidden;
        }
        .logo {
            float: left;
        }
        .university-info {
            text-align: center;
        }
        .clear {
            clear: both;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
        }
        .paid {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            border: 2px dashed #000;
            padding: 10px;
            margin: 10px auto;
            width: 200px;
        }
        .no-border {
            border: none !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-direction: column">
                <div style="flex: 1; text-align: left;">
                    <img src="{{ asset('images/logo.png') }}" width="120" alt="University Logo">
                </div>
                <div style="flex: 2; text-align: center;">
                    <h2>THE NEOTIA UNIVERSITY</h2>
                    <p>Diamond Harbour Road, Sarisha Hat, Sarisha, West Bengal - 743368, India</p>
                    <h3>Payment Receipt</h3>
                    <h3>Receipt No: {{ $payment->payment_receipt}}</h3>
                </div>
                <div style="flex: 1;"></div>
            </div>
        </div>
        <table>
            <tr>
                <td><strong>Receipt Date</strong></td>
                <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td>{{ $student->name }}</td>
            </tr>
            <tr>
                <td><strong>UID No.</strong></td>
                <td>{{ $student->registration_number }}</td>
            </tr>
            <tr>
                <td><strong>Course</strong></td>
                <td>{{ $courseName }}</td>
            </tr>
            <tr>
                <td><strong>Contact No.</strong></td>
                <td>{{ $student->phone_no }}</td>
            </tr>
            <tr>
                <td><strong>Installment</strong></td>
                <td>{{ $semesterName }} Semester</td>
            </tr>
            <tr>
                <td><strong>Payment Type</strong></td>
                <td>Online Payment</td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th>Heads</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($feeBreakdown as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td style="text-align: right;">{{ number_format($item['amount'], 2) }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td><strong>Total Paid</strong></td>
                    <td style="text-align: right;"><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                </tr>

                <tr>
                    <td colspan="2" class="no-border">
                        <div class="paid">P A I D</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
