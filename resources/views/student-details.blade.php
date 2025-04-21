<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #818cf8;
            --background-color: #f0f2f5;
            --card-bg: #ffffff;
            --text-color: #1e293b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            min-height: 100vh;
            padding: 2rem;
            overflow-x: hidden;
        }

        .profile-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .profile-card {
            background: var(--card-bg);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            animation: float 6s ease-in-out infinite;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 3rem 2rem;
            position: relative;
            display: flex;
            text-align: center;
            margin-top:0px;
        }

        .profile-image-container {
            margin: -80px auto 20px;
            width: 160px;
            height: 160px;
            position: relative;
            z-index: 1;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--card-bg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transform: perspective(500px) rotateX(0deg) rotateY(0deg);
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: perspective(500px) rotateX(5deg) rotateY(5deg);
        }

        .profile-body {
            padding: 2rem;
        }

        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-card {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .info-card strong {
            color: var(--primary-color);
            display: block;
            margin-bottom: 0.5rem;
        }

        .academic-card {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            border-left: 5px solid var(--primary-color);
            transition: transform 0.2s ease;
        }

        .academic-card:hover {
            transform: translateY(-5px);
        }

        @keyframes float {
            0% { transform: translateY(0px) rotateX(0deg); }
            50% { transform: translateY(-15px) rotateX(2deg); }
            100% { transform: translateY(0px) rotateX(0deg); }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h2 class="text-white mb-0">Student Profile</h2>
            </div>
            <div class="profile-image-container">
                @if(isset($imageName))
                    <img src="{{ asset('storage/students/images/' . $imageName) }}" alt="Student Image" class="profile-image">
                @else
                    <div class="profile-image bg-secondary d-flex align-items-center justify-content-center text-white">
                        No Image
                    </div>
                @endif
            </div>

            <div class="profile-body">
                <h4 class="section-title">Personal Information</h4>
                <div class="info-grid">
                    <div class="info-card">
                        <strong>Registration Number</strong>
                        {{ $student->registration_number }}
                    </div>
                    <div class="info-card">
                        <strong>Full Name</strong>
                        {{ $student->name }}
                    </div>
                    <div class="info-card">
                        <strong>Father's Name</strong>
                        {{ $student->basicInformation->fathersname }}
                    </div>
                    <div class="info-card">
                        <strong>Mother's Name</strong>
                        {{ $student->basicInformation->mothersname }}
                    </div>
                    <div class="info-card">
                        <strong>Date of Birth</strong>
                        {{ $student->basicInformation->date_of_birth }}
                    </div>
                    <div class="info-card">
                        <strong>Gender</strong>
                        {{ $student->basicInformation->gender }}
                    </div>
                </div>

                <h4 class="section-title">Contact Information</h4>
                <div class="info-grid">
                    <div class="info-card">
                        <strong>Email</strong>
                        {{ $student->email }}
                    </div>
                    <div class="info-card">
                        <strong>Phone</strong>
                        {{ $student->phone_no }}
                    </div>
                </div>

                <h4 class="section-title">Academic Details</h4>
                @forelse ($academicDetails as $academicDetail)
                    <div class="academic-card">
                        <strong>Academic Record #{{ $loop->iteration }}</strong>
                        <p class="mb-1">Course: {{ $academicDetail->course->course_name ?? 'N/A' }}</p>
                        <p class="mb-1">School: {{ $academicDetail->school->school_name ?? 'N/A' }}</p>
                        <p class="mb-1">Specialization: {{ $academicDetail->specialization->specialization_name ?? 'N/A' }}</p>
                        <p class="mb-1">Class: {{ $academicDetail->class ?? 'N/A' }}</p>
                        <p class="mb-0">Roll No: {{ $academicDetail->roll_no ?? 'N/A' }}</p>
                    </div>
                @empty
                    <div class="academic-card">
                        <p>No Academic Details Available</p>
                    </div>
                @endforelse

                <h4 class="section-title">Address</h4>
                <div class="info-card">
                    <strong>Location</strong>
                    {{ $student->address->district->district_name ?? 'N/A' }},
                    {{ $student->address->state->state_name ?? 'N/A' }},<br>
                    {{ $student->address->country->country_name ?? 'N/A' }} - 
                    {{ $student->address->pin_no }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>