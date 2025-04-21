<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            position: relative;
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0px;
            width: 98.8%;
            background:rgb(24, 24, 24);
            backdrop-filter: blur(10px);
            padding: 15px 5%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar a {
            color:rgb(255, 255, 255);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            margin-left: 40px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar a:hover {
            color: #3498db;
        }

        .navbar a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: #3498db;
            transition: width 0.3s ease;
        }

        .navbar a:hover::after {
            width: 100%;
        }


        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
            padding: 0 5%;
            position: relative;
            overflow: hidden;
            animation: bgPulse 10s infinite alternate;
            margin-top: 60px; /* Added to prevent overlap with navbar */
        }

        .hero-section {
            flex: 1;
            max-width: 650px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            backdrop-filter: blur(12px);
            animation: slideInLeft 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards, 
                      floatSection 6s ease-in-out infinite;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .image-container {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            perspective: 1200px;
            position: relative;
        }

        img {
            max-width: 85%;
            transform: rotateY(20deg) rotateX(15deg);
            animation: floatImage 4s ease-in-out infinite, 
                      imageEntrance 1.5s ease-out forwards,
                      glowImage 3s infinite alternate;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: rotateY(25deg) rotateX(20deg) scale(1.05);
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: 900;
            background: linear-gradient(45deg, #2c3e50, #3498db);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.5rem;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .hero-section h1::after {
            content: '';
            position: absolute;
            width: 4px;
            height: 60%;
            background: #3498db;
            right: -10px;
            top: 20%;
            animation: blink 0.7s infinite;
        }

        .hero-section h4 {
            font-size: 1.8rem;
            color: #2d3436;
            background: linear-gradient(45deg, #636e72, #b2bec3);
            -webkit-background-clip: text;
            background-clip: text;
            opacity: 0;
            animation: fadeInUp 0.8s 1.2s ease-out forwards,
                      textGlow 2s infinite alternate;
        }

        .hero-section h5 {
            font-size: 1.3rem;
            color: #636e72;
            opacity: 0;
            animation: fadeInUp 0.8s 1.6s ease-out forwards,
                      subtleBounce 2s infinite;
        }

        .buttons-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            justify-content: center;
            opacity: 0;
            animation: fadeInButtons 1s 2.2s ease-out forwards;
        }

        .btn {
            padding: 14px 30px;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.4s ease;
            transform-style: preserve-3d;
            position: relative;
            border: none;
            color: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: buttonPulse 2s infinite;
        }

        .btn i {
            margin-right: 8px;
            transition: transform 0.3s ease;
        }

        .btn:hover i {
            transform: scale(1.2) rotate(10deg);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
            transform: skewX(-20deg);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-5px) scale(1.05) rotate(2deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        .btn:active {
            transform: translateY(2px) scale(0.98);
        }

        .btn-primary { 
            background: linear-gradient(45deg, #0984e3, #00ddeb);
        }
        .btn-secondary { 
            background: linear-gradient(45deg, #00b894, #55efc4);
        }

        .section {
            min-height: 100vh;
            padding: 80px 5% 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
        }

        .section h2 {
            font-size: 3rem;
            font-weight: 900;
            color: #2c3e50;
            margin-bottom: 2rem;
            text-align: center;
        }

        .section-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .section-content p {
            font-size: 1.1rem;
            color: #636e72;
            line-height: 1.8;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .service-card {
            padding: 20px;
            background: white;
            border-radius: 10px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 20px;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }

        .contact-form button {
            padding: 12px;
            background: linear-gradient(45deg, #0984e3, #00ddeb);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .contact-form button:hover {
            transform: scale(1.05);
        }
        .footer {
        background: #2c3e50;
        color: #fff;
        text-align: center;
        padding: 20px 5%;
        font-size: 1rem;
        box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.2);
    }

    .footer-content p {
        margin-bottom: 10px;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .footer-links a {
        color: #3498db;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #00ddeb;
    }

        @keyframes slideInLeft {
            from { transform: translateX(-100px) scale(0.9); opacity: 0; }
            to { transform: translateX(0) scale(1); opacity: 1; }
        }

        @keyframes imageEntrance {
            from { transform: rotateY(40deg) rotateX(25deg) translateX(150px); opacity: 0; }
            to { transform: rotateY(20deg) rotateX(15deg) translateX(0); opacity: 1; }
        }

        @keyframes floatImage {
            0%, 100% { transform: translateY(0) rotateY(20deg) rotateX(15deg); }
            50% { transform: translateY(-25px) rotateY(20deg) rotateX(15deg) translateX(10px); }
        }

        @keyframes fadeInButtons {
            from { opacity: 0; transform: translateY(-30px) rotateX(-20deg); }
            to { opacity: 1; transform: translateY(0) rotateX(0deg); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes floatSection {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        @keyframes textGlow {
            0% { text-shadow: 0 0 5px rgba(0, 0, 0, 0.1); }
            100% { text-shadow: 0 0 15px rgba(52, 152, 219, 0.3); }
        }
        @keyframes buttonPulse {
            0% { box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
            50% { box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); }
            100% { box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About Us</a>
        <a href="#services">Services</a>
        <a href="#contact">Contact</a>
    </nav>

    <div class="particles" id="particles"></div>
    <div class="main-container" id="home">
        <div class="hero-section">
            <h1 id="typewriter"></h1>
            <h4>Your journey starts here</h4>
            <h5>— choose your login and get started!</h5>
            <div class="buttons-container">
                <a href="{{ route('admin.login.form') }}" class="btn btn-primary">
                    <i class="fas fa-user-shield"></i> Admin Login
                </a>
                <a href="{{ route('student.login.form') }}" class="btn btn-secondary">
                    <i class="fas fa-user-graduate"></i> Student Login
                </a>
            </div>
        </div>
        <div class="image-container">
            <img src="{{ asset('images/home (2).jpg') }}" alt="3D System Illustration">
        </div>
    </div>
    
    <section class="section" id="about">
        <h2>About Us</h2>
        <div class="section-content">
            <p>
                We are a dedicated team committed to providing innovative solutions for educational institutions. 
                Our system is designed to streamline administrative tasks and enhance the student experience through 
                cutting-edge technology and user-friendly interfaces. With years of experience in educational 
                technology, we strive to empower both administrators and students with tools that make learning 
                and management more efficient and effective.
            </p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section" id="services">
        <h2>Services</h2>
        <div class="section-content">
            <div class="services-grid">
                <div class="service-card">
                    <h3>Student Management</h3>
                    <p>Efficiently manage student records, attendance, and performance tracking.</p>
                </div>
                <div class="service-card">
                    <h3>Admin Dashboard</h3>
                    <p>Comprehensive tools for administrators to oversee operations.</p>
                </div>
                <div class="service-card">
                    <h3>Secure Login</h3>
                    <p>Safe and reliable access for both students and administrators.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section" id="contact">
        <h2>Contact Us</h2>
        <div class="section-content">
            <p>Have questions? Get in touch with us!</p>
            <form class="contact-form">
                <input type="text" placeholder="Your Name" required>
                <input type="email" placeholder="Your Email" required>
                <textarea rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Your System Name. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
                <a href="#">FAQs</a>
            </div>
        </div>
    </footer>

    <script>
        const text = "Welcome to Our System!";
        const speed = 80;
        let i = 0;
        const typewriter = document.getElementById("typewriter");

        function typeEffect() {
            if (i < text.length) {
                typewriter.innerHTML += text.charAt(i);
                i++;
                setTimeout(typeEffect, speed);
            } else {
                setTimeout(() => {
                    typewriter.style.transition = 'opacity 0.5s, transform 0.5s';
                    typewriter.style.opacity = '0';
                    typewriter.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        typewriter.innerHTML = "";
                        typewriter.style.opacity = '1';
                        typewriter.style.transform = 'translateY(0)';
                        i = 0;
                        typeEffect();
                    }, 500);
                }, 2500);
            }
        }
        typeEffect();  

    document.querySelectorAll('.navbar a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if(targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    </script>
</body>
</html>
