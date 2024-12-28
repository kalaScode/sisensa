<x-navbar></x-navbar>
<div class="max-w-4xl mx-auto">
    <main class="p-6">
        <div class="flex items-center gap-3 mb-6">
            <h1 class="text-xl font-semibold text-gray-800">Detail Karyawan</h1>
            <i class="fas fa-users text-custom"></i>
        </div>
        <div class="bg-custom rounded-lg p-6">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-lg overflow-hidden bg-white p-2">
                        <img src="https://creatie.ai/ai/api/search-image?query=Professional headshot of a person wearing business attire with a friendly expression, high quality studio lighting against a neutral background&width=200&height=200&orientation=squarish&flag=eba54ef0-3d4d-408b-8eeb-90033bbb466e&flag=7ef411fa-b265-4587-9da8-23f2caa02129&flag=73c177ed-27f1-4871-875c-e9cea60a45f9&flag=7ee60eb8-cb38-4c9e-9c5a-169b003c3dec&flag=6e7f0498-fe84-40a7-87d1-1d72ed615c2d" alt="Employee" class="w-full h-full object-cover rounded-lg" />
                    </div>
                    <h2 class="text-white mt-4 font-medium">Rizky Alif Ichwanto</h2>
                    <p class="text-gray-300">Web Developer</p>
                    <div class="bg-[#FACC15] rounded-lg px-4 py-2 mt-4">
                        <div class="text-[#122036] font-medium">Saldo Cuti</div>
                        <div class="text-[#122036] font-bold text-center">12 Hari</div>
                    </div>
                </div>
                <div class="bg-gray-100 rounded-lg p-4 flex-grow">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Nama Perusahaan</label>
                            <input type="text" value="PT Berkreasi" class="w-full rounded-lg border-gray-300" disabled="" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                            <input type="email" value="222212857@stis.ac.id" class="w-full rounded-lg border-gray-300" disabled="" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Telepon</label>
                            <input type="tel" value="+62 812 78X XXXX" class="w-full rounded-lg border-gray-300" disabled="" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                            <input type="text" value="Jl. Otista No.64C" class="w-full rounded-lg border-gray-300" disabled="" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-1">Pemberi Persetujuan</label>
                            <input type="text" value="Teguh Raharjo" class="w-full rounded-lg border-gray-300" disabled="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-6">
            <a href="/daftar_karyawan"><button class="!rounded-button bg-red-500 text-white px-6 py-2 hover:bg-red-600 transition-colors">Kembali</button>
            </a>
            <div class="space-x-4">
                <button class="!rounded-button bg-blue-500 text-white px-6 py-2 hover:bg-blue-600 transition-colors" onclick="toggleEdit()">Edit</button>
                <button class="!rounded-button bg-green-500 text-white px-6 py-2 hover:bg-green-600 transition-colors hidden" id="saveBtn">Simpan</button>
            </div>
        </div>
    </main>
</div>
<x-footer></x-footer>