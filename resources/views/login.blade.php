<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Masuk</title>
    <link href="https://fonts.googleapis.com/css2?family=Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .parallax-bg {
            background: linear-gradient(45deg, #0d1437 0%, #1a237e 100%);
            position: relative;
            overflow: hidden;
        }
        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 1.5s infinite ease-in-out;
        }
        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 1; }
        }
        .login-container {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }
        .form-input:focus {
            border-color: #4fc3f7;
            box-shadow: 0 0 15px rgba(79, 195, 247, 0.3);
        }
        .login-btn {
            background: linear-gradient(45deg, #1a237e, #3949ab);
            transition: all 0.3s ease;
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 35, 126, 0.4);
        }
    </style>
</head>
<body class="min-h-screen font-['Jakarta Sans']">
    <x-navbarnone></x-navbarnone>
        <div class="parallax-bg min-h-screen flex items-center justify-center p-4" id="starfield">
            <div class="login-container max-w-md w-full p-8 rounded-lg shadow-2xl">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-semibold text-white mb-2">SISENSA</h1>
                    <p class="text-blue-200">Silakan masuk ke akun Anda</p>
                </div>
                
                <form method="POST" action="{{ route('login.process') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-blue-200 mb-2" for="email">Email</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-3 text-blue-300"></i>
                            <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required
                                class="form-input w-full py-2 px-10 rounded-lg text-white placeholder-blue-300">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-blue-200 mb-2" for="password">Kata Sandi</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-3 text-blue-300"></i>
                            <input type="password" name="password" id="password" placeholder="Masukkan kata sandi" required
                                class="form-input w-full py-2 px-10 rounded-lg text-white placeholder-blue-300">
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center text-blue-200">
                            <input type="checkbox" class="form-checkbox rounded border-blue-300 text-custom mr-2"> Ingat saya
                        </label>
                        <a href="#" class="text-blue-300 hover:text-white transition-colors">Lupa kata sandi?</a>
                    </div>
                    
                    <button type="submit" class="login-btn !rounded-button w-full py-3 text-white font-medium hover:bg-blue-700 transition-all">
                        Masuk
                    </button>
                </form>
                
                <p class="text-center mt-6 text-blue-200">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-blue-300 hover:text-white transition-colors">Daftar sekarang</a>
                </p>
            </div>
        </div>
    <x-footer></x-footer>

    <script>
        function createStars() {
            const starfield = document.getElementById('starfield');
            const numberOfStars = 100;
            
            for (let i = 0; i < numberOfStars; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                
                const size = Math.random() * 3;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                star.style.animationDelay = `${Math.random() * 2}s`;
                
                starfield.appendChild(star);
            }
        }
        
        createStars();
        
        document.addEventListener('mousemove', (e) => {
            const stars = document.querySelectorAll('.star');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            
            stars.forEach(star => {
                const rect = star.getBoundingClientRect();
                const starX = (rect.left + rect.width / 2) / window.innerWidth;
                const starY = (rect.top + rect.height / 2) / window.innerHeight;
                
                const deltaX = (mouseX - starX) * 20;
                const deltaY = (mouseY - starY) * 20;
                
                star.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
            });
        });
    </script>
</body>
</html>
