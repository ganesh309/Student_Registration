🎓 Student Registration System.

This is a web-based Student Registration System built using Laravel, featuring a multi-step registration form, admin dashboard, student search,and fees management functionalities. The system is designed for educational institutions to manage student registrations efficiently.

📌 Features

    📝 Multi-step student registration (Basic Info, Courses, Education, Documents, Password)
    📷 Image upload with cropping
    📍 Address selection using Country → State → District linkage
    🔍 Student list with search & filter (by country, state, district)
    💸 Fees management with structure-wise scheduling
    💳 Payment tracking with universal search & advanced filters
    🔐 Secure login for admin (with optional Google Authenticator 2FA)
    🔐 Forgot password via email with OTP and reset link
    📅 Dashboard for easy navigation
    
🚀 Tech Stack

    Backend: Laravel 9
    Frontend: Blade, HTML, CSS, JavaScript, Bootstrap 5, jQuery, SweetAlert
    Database: MySQL
    Authentication: Laravel Auth, Google 2FA (optional)
    Email: Laravel Mailables with SMTP setup
    
⚙️ Installation

    git clone https://github.com/ganesh309/Student_Registration.git
    cd Student_Registration
    composer install
    cp .env.example .env
    php artisan key:generate

1. Configure .env file:
   
    Database settings
   
    Mail credentials
   
    App URL

3. Serve the application:
   
   php artisan serve

🔑 Default Admin Login:

    Email: admin@example.com
    Password: admin123

📂 Project Structure
   
    app/
    ├── Http/Controllers/         # Controllers (Student, Admin, Mentor)
    ├── Models/                   # Eloquent Models
    ├── Mail/                     # Email & OTP logic
    resources/views/              # Blade files
    routes/web.php                # Web routes
    database/migrations/          # Database schema

📸 Screenshots

<img width="960" alt="Screenshot 2025-06-02 162829" src="https://github.com/user-attachments/assets/a63666fd-1404-4128-964c-22dcd09eb906" />

<img width="960" alt="Screenshot 2025-06-02 162858" src="https://github.com/user-attachments/assets/d4343b8b-b462-4da5-893c-6a62c1f26f17" />

<img width="960" alt="Screenshot 2025-06-02 162935" src="https://github.com/user-attachments/assets/97139e45-07e4-4a32-b366-e99655029e96" />

<img width="949" alt="Screenshot 2025-06-02 163053" src="https://github.com/user-attachments/assets/df078434-e19b-489b-96f2-ec5be1cf5308" />

<img width="949" alt="Screenshot 2025-06-02 163146" src="https://github.com/user-attachments/assets/acfd1f5e-d72f-4ab6-ba65-ce529732f814" />

<img width="959" alt="Screenshot 2025-06-02 163251" src="https://github.com/user-attachments/assets/31291673-a902-47ad-8183-32e9a40083d1" />

<img width="950" alt="Screenshot 2025-06-02 163311" src="https://github.com/user-attachments/assets/5833c4ef-2b94-4fdd-b278-f32d12ded27f" />

<img width="960" alt="Screenshot 2025-06-02 163334" src="https://github.com/user-attachments/assets/bc7719ee-4663-44dc-8d95-fda8d7894e7b" />

<img width="960" alt="Screenshot 2025-06-02 163354" src="https://github.com/user-attachments/assets/30bfcecf-86b0-4c04-ba9a-76df968ba2a3" />

<img width="959" alt="Screenshot 2025-06-02 163427" src="https://github.com/user-attachments/assets/ef01c9b9-a722-4d9f-8a7b-6683af87b389" />

<img width="960" alt="Screenshot 2025-06-02 163457" src="https://github.com/user-attachments/assets/be140f1e-8954-486a-b52d-13e7e991fbd8" />

<img width="960" alt="Screenshot 2025-06-02 163522" src="https://github.com/user-attachments/assets/1a725c01-6ae5-49e0-9cc1-c0a34a4130d5" />

<img width="960" alt="Screenshot 2025-06-02 163606" src="https://github.com/user-attachments/assets/d2de336d-1316-41fe-afa1-ecadec8ebf59" />

<img width="958" alt="Screenshot 2025-06-02 163624" src="https://github.com/user-attachments/assets/96f3ab50-878f-43b7-b986-23188fd3a50b" />

<img width="956" alt="Screenshot 2025-06-02 163723" src="https://github.com/user-attachments/assets/07a6c408-5196-4ec7-b286-7e6b053c7240" />

<img width="959" alt="Screenshot 2025-06-02 164015" src="https://github.com/user-attachments/assets/572d9b05-910e-4578-b41c-b5c35ef5167a" />

<img width="960" alt="Screenshot 2025-06-02 164118" src="https://github.com/user-attachments/assets/7cbdd812-1c9a-4b7c-97de-d39dbd9b4d0b" />

<img width="960" alt="Screenshot 2025-06-02 164159" src="https://github.com/user-attachments/assets/06d1088e-a0e1-4fc6-8502-e38727956798" />




