<div class="flex">
    <x-sidebar></x-sidebar>
    <!-- Main Container -->
    <div class="flex-1 ml-64 p-5">
        <h1 class="text-5xl font-bold mb-5 text-gray-800">Halaman Otorisasi Karyawan</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Section: Atur Role User -->
        <div class="bg-white shadow rounded-lg p-10">
            <h2 class="text-xl font-semibold mb-3 text-gray-700">Atur Role User</h2>

            <!-- Search Form -->
            <div class="relative mb-6">
                <form action="{{ route('otorisasi-karyawan.index') }}" method="GET"
                    class="flex flex-wrap items-center gap-4 mb-6">
                    <!-- Input Pencarian -->
                    <div class="flex items-center rounded-lg shadow-sm max-w-md w-full">
                        <input type="text" name="search"
                            class="flex-grow px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-200 rounded-l-lg"
                            placeholder="Cari karyawan..." value="{{ request('search') }}" />
                        <button type="submit"
                            class="bg-blue-400 text-white px-4 py-2 text-sm rounded-r-lg hover:bg-blue-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.0" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- User Table -->
            @if ($users->isEmpty())
                <div class="p-4 mb-4 text-sm text-yellow-800 bg-yellow-100 rounded-lg border-l-4 border-yellow-500"
                    role="alert">
                    Karyawan tidak ditemukan.
                </div>
            @else
                <table class="min-w-full bg-white border border-black">
                    <thead class="bg-[#122036] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-l font-semibold text-white tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-l font-semibold text-white tracking-wider">Role</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="border border-gray-300 p-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img src="{{ $user->Avatar ? asset('storage/' . $user->Avatar) : '/img/profil.jpg' }}"
                                                alt="Foto Profil"
                                                class="w-full h-full rounded-full object-cover border-2 border-[#F6CD61]">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">ID: {{ $user->user_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="border border-gray-300 p-3">
                                    <form action="{{ route('user-roles.store', $user->user_id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="id_Otoritas" class="border-gray-300 rounded-lg p-2"
                                            onchange="this.form.submit()">
                                            @foreach ($allOtorisasi as $role)
                                                @if ($otorisasi == 1 || ($otorisasi == 2 && $role->id_Otoritas != 1))
                                                    <option value="{{ $role->id_Otoritas }}"
                                                        {{ $user->id_Otoritas == $role->id_Otoritas ? 'selected' : '' }}>
                                                        {{ $role->nama_Otoritas }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            <!-- Pagination -->
            <div class="mt-6 flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Menampilkan <span class="font-medium">{{ $users->firstItem() }}</span> sampai <span
                        class="font-medium">{{ $users->lastItem() }}</span> dari <span
                        class="font-medium">{{ $users->total() }}</span> data
                </div>
                <div class="flex space-x-2 items-center">
                    {{ $users->links() }} <!-- Pagination Laravel -->
                </div>
            </div>
        </div>
    </div>
</div>
