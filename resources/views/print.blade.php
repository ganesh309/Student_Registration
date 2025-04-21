<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details - {{ $student->name }}</title>
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div>
            <h2>{{ $student->name }}</h2>
            <p>Registration Number: {{ $student->registration_number }}</p>
        </div>
        @if($student->image)
            <img src="{{ asset('storage/students/images/' . $student->image) }}" class="student-photo" alt="Student Image">
        @endif
    </div>

    <div class="section-title">Personal Information</div>
    <table class="details-table">
        <tr>
            <th>Father's Name</th>
            <td>{{ $student->basicInformation->fathersname }}</td>
        </tr>
        <tr>
            <th>Mother's Name</th>
            <td>{{ $student->basicInformation->mothersname }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ $student->basicInformation->date_of_birth }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $student->basicInformation->gender }}</td>
        </tr>
    </table>

    <div class="section-title">Contact Information</div>
    <table class="details-table">
        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $student->phone_no }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>
                @if($student->address->district) {{ $student->address->district->district_name }}, @else N/A, @endif
                @if($student->address->state) {{ $student->address->state->state_name }}, @else N/A, @endif
                @if($student->address->country) {{ $student->address->country->country_name }}, @else N/A, @endif
                @if($student->address->pin_no) {{ $student->address->pin_no }} @else N/A @endif
            </td>
        </tr>
    </table>

    <!-- Academic Details Section -->
    <div class="section-title">Academic Information</div>

    @foreach($student->academicDetails as $academicDetail)
        <table class="details-table" style="margin-bottom: 20px;">
            <tr>
                <th>Class</th>
                <td>{{ $academicDetail->class ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Roll Number</th>
                <td>{{ $academicDetail->roll_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Specialization</th>
                <td>
                    @if($academicDetail->specialization_id)
                        {{ $academicDetail->specialization->specialization_name ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <th>Course</th>
                <td>
                    @if($academicDetail->course_id)
                        {{ $academicDetail->course->course_name ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <th>University</th>
                <td>
                    @if($academicDetail->school_id)
                        {{ $academicDetail->school->school_name ?? 'N/A' }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
        </table>
    @endforeach

    <div class="signature-box">
        @if($student->signature)
            <img src="{{ asset('storage/students/signatures/' . $student->signature) }}" class="signature-img" alt="Student Signature">
        @endif
        <div style="margin-top:5px;">Student Signature</div>
    </div>

    <div class="footer">
        Printed on: {{ now()->format('d-m-Y') }}
    </div>

    <script>
        window.print();
        window.onafterprint = function () {
            window.location.href = "{{ route('students.index') }}";
        };
    </script>
</body>
</html>
