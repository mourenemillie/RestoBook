@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen py-16 flex items-center font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-2xl text-center">
        
        <div class="inline-flex items-center justify-center w-24 h-24 bg-orange-50 rounded-[2rem] text-orange-500 mb-8 shadow-sm border border-orange-100">
            <span class="material-symbols-outlined text-[48px]">hourglass_empty</span>
        </div>

        <span class="text-orange-600 font-bold uppercase tracking-widest text-xs block mb-2">Pendaftaran Berhasil</span>
        <h1 class="text-4xl font-black text-slate-900 mb-4">Menunggu Verifikasi Admin</h1>
        <p class="text-gray-500 max-w-md mx-auto mb-10">
            Terima kasih telah bergabung dengan RestoBook! Saat ini profil restoran Anda sedang ditinjau oleh tim Admin kami. Mohon cek kembali secara berkala.
        </p>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10 relative overflow-hidden text-left">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500/5 rounded-full blur-2xl"></div>
            <h3 class="text-lg font-bold text-slate-800 mb-3">Apa langkah selanjutnya?</h3>
            <ul class="text-sm text-gray-500 space-y-3 font-medium">
                <li class="flex gap-3">
                    <span class="text-orange-500 font-bold">1.</span> Admin akan memverifikasi legalitas dan kebenaran data restoran Anda (1x24 jam).
                </li>
                <li class="flex gap-3">
                    <span class="text-orange-500 font-bold">2.</span> Setelah disetujui, Anda akan mendapatkan akses penuh ke Dashboard Owner.
                </li>
                <li class="flex gap-3">
                    <span class="text-orange-500 font-bold">3.</span> Restoran Anda akan otomatis tampil di halaman utama pengunjung.
                </li>
            </ul>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-white text-slate-700 border border-gray-200 px-8 py-4 rounded-2xl font-bold hover:bg-gray-50 transition-all flex items-center justify-center gap-2 cursor-pointer w-full">
                    Logout Sementara
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
