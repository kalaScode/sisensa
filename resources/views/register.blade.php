<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Sisensa</title>
</head>
<body>
  <div class="min-h-full">
    <x-navbarnone></x-navbarnone>
    <div class="max-w-7xl mx-auto py-6 sm:px-6">
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Form Register -->
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-center mb-6">Daftar Akun Baru</h2>
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf
                <div class="mb-4">
                    <label for="company_code" class="block text-gray-700">Kode Perusahaan</label>
                    <input type="text" id="company_code" name="company_code" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700">Telepon</label>
                    <input type="text" id="phone" name="phone" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="terms" required>
                        <span class="ml-2 text-gray-700">Dengan mendaftar, Anda menyetujui syarat dan ketentuan kami.</span>
                    </label>
                </div>
                <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600">Daftar</button>
            </form>
            <p class="mt-4 text-center text-gray-600">Sudah punya akun? <a href="/login" class="text-yellow-500">Login di sini</a></p>
        </div>
        <!-- End Form Register -->
      </div>
    </main>
    </div>
    <x-footer></x-footer>
  </div>  
</body>
</html>