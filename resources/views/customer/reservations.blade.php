@extends('layouts.app')

@section('content')
<div class="bg-[#fafafa] min-h-screen py-12 font-['Plus_Jakarta_Sans',sans-serif]">
    <div class="container mx-auto px-6 max-w-6xl">
        
        {{-- Penanganan Error Validasi dari Controller --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-3xl text-sm font-medium shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM ACTION: Diarahkan ke rute store milik Anda --}}
        <form action="{{ route('customer.reservations.store') }}" method="POST">
            @csrf
            
            {{-- DATA HIDDEN: Mengirimkan ID restoran untuk relasi database --}}
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <div class="flex flex-col lg:flex-row gap-8 bag-isi">
                
                {{-- KIRI: FORM RESERVASI --}}
                <div class="lg:w-2/3">
                    <span class="text-orange-600 font-bold uppercase tracking-widest text-xs">Detail Reservasi</span>
                    <h1 class="text-4xl font-black text-slate-900 mt-2 mb-4">Amankan Meja Anda di {{ $restaurant->name }}</h1>
                    <p class="text-gray-500 mb-8 text-sm">Silakan tentukan waktu kedatangan, meja pilihan, dan pre-order menu hidangan favorit Anda.</p>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100/80 mb-8">
                        <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                            <span>📅</span> Informasi Jadwal & Kapasitas
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Kunjungan</label>
                                {{-- DISESUAIKAN: Name diubah ke reservation_date & set minimal hari ini --}}
                                <input type="date" name="reservation_date" required min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-orange-500 focus:bg-white transition-all text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jam Kedatangan</label>
                                {{-- DISESUAIKAN: Name diubah ke reservation_time --}}
                                <input type="time" name="reservation_time" required class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-orange-500 focus:bg-white transition-all text-slate-700">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jumlah Orang (Tamu)</label>
                                {{-- DISESUAIKAN: Name diubah ke num_guests sesuai struktur database --}}
                                <input type="number" name="num_guests" required min="1" placeholder="Contoh: 4" class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-orange-500 focus:bg-white transition-all text-slate-700">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100/80 mb-8">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <span>🪑</span> Pilih Meja Tersedia
                        </h3>
                        <p class="text-xs text-gray-400 mb-6">Pilih meja yang siap digunakan di restoran ini.</p>
                        
                        {{-- DISESUAIKAN: Mengganti pilihan radio string area menjadi pilihan table_id asli dari database --}}
                        <div class="grid grid-cols-1 gap-4">
                            <select name="table_id" required class="w-full bg-slate-50 border border-slate-100 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-orange-500 focus:bg-white transition-all text-slate-700">
                                <option value="" disabled selected>-- Pilih Nomor Meja --</option>
                                @forelse($restaurant->tables->where('status', 'available') as $table)
                                    <option value="{{ $table->id }}">Meja No. {{ $table->table_number }} (Kapasitas: {{ $table->capacity }} Orang)</option>
                                @empty
                                    <option value="" disabled>Maaf, tidak ada meja yang tersedia untuk saat ini</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100/80 mb-8">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <span>📝</span> Catatan Tambahan (Opsional)
                        </h3>
                        <textarea name="notes" rows="3" placeholder="Contoh: Minta kursi bayi, area dekat jendela, atau makanan tidak pedas..." class="w-full bg-slate-50 border border-slate-100 rounded-2xl p-4 text-sm font-medium focus:outline-none focus:border-orange-500 focus:bg-white transition-all text-slate-700"></textarea>
                    </div>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100/80">
                        <h3 class="text-lg font-bold text-slate-800 mb-2 flex items-center gap-2">
                            <span>🍲</span> Pre-Order Menu Kuliner
                        </h3>
                        <p class="text-xs text-gray-400 mb-6">Pesan makanan sekaligus untuk disajikan langsung saat Anda tiba di lokasi.</p>

                        <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
                            @forelse($restaurant->menus as $menu)
                            <div class="flex items-center justify-between p-4 bg-slate-50/60 rounded-3xl border border-slate-100/70 menu-item-row">
                                <div class="flex items-center gap-4">
                                    {{-- DISESUAIKAN: Name array menu diselaraskan --}}
                                    <input type="checkbox" name="menus[{{ $menu->id }}][id]" value="{{ $menu->id }}" class="menu-checkbox accent-orange-600 w-5 h-5 rounded-lg cursor-pointer">
                                    
                                    @if($menu->image)
                                        <img src="{{ asset('storage/' . $menu->image) }}" class="w-14 h-14 object-cover rounded-xl" alt="{{ $menu->name }}">
                                    @else
                                        <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center font-bold text-lg">🍽️</div>
                                    @endif
                                    
                                    <div>
                                        <span class="block font-bold text-sm text-slate-800 menu-name">{{ $menu->name }}</span>
                                        <span class="text-xs text-orange-600 font-extrabold menu-price-raw" data-price="{{ $menu->price }}">
                                            Rp {{ number_format($menu->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">Qty</span>
                                    {{-- DISESUAIKAN: Name array quantity diselaraskan --}}
                                    <input type="number" name="menus[{{ $menu->id }}][quantity]" value="1" min="1" disabled class="menu-qty w-14 text-center bg-gray-50 text-gray-500 font-bold text-sm px-2 py-1.5 border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 disabled:opacity-50">
                                </div>
                            </div>
                            @empty
                            <p class="text-sm text-gray-400 italic text-center py-6">Belum ada daftar menu makanan di restoran ini.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- KANAN: RINGKASAN PEMBAYARAN (STICKY BOX) --}}
                <div class="lg:w-1/3">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100/80 sticky top-12">
                        <h3 class="text-lg font-black text-slate-900 mb-6 pb-4 border-b border-gray-50 flex items-center gap-2">
                            <span>🧾</span> Ringkasan Pesanan
                        </h3>

                        <div class="space-y-4 mb-6 max-h-[220px] overflow-y-auto pr-1" id="selected-menus-list">
                            {{-- Diisi secara otomatis oleh JavaScript --}}
                        </div>

                        <div class="space-y-3 pt-4 border-t border-dashed border-gray-100 text-sm">
                            <div class="flex justify-between text-gray-500">
                                <span>Subtotal Hidangan</span>
                                <span id="summary-subtotal" class="font-bold text-slate-700">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>Biaya Layanan Aplikasi</span>
                                <span id="summary-tax" class="font-bold text-slate-700">Rp 2.000</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 text-base">
                                <span class="font-black text-slate-900">Total Estimasi</span>
                                <span id="summary-total" class="font-black text-orange-600 text-xl">Rp 2.000</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-orange-600 text-white font-black py-4 rounded-2xl mt-8 shadow-xl shadow-orange-100 hover:bg-orange-700 transition-all flex items-center justify-center gap-2 text-sm uppercase tracking-wider">
                            Lanjut Ke Pembayaran ➔
                        </button>
                        
                        <p class="text-[10px] text-gray-400 text-center mt-4">
                            🔒 Pembayaran diproses aman via payment gateway Midtrans.
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    const checkboxes = document.querySelectorAll('.menu-checkbox');
    const selectedMenusList = document.getElementById('selected-menus-list');
    const summarySubtotal = document.getElementById('summary-subtotal');
    const summaryTax = document.getElementById('summary-tax');
    const summaryTotal = document.getElementById('summary-total');

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    function calculateTotal() {
        let subtotal = 0;
        let html = '';
        let hasSelection = false;

        document.querySelectorAll('.menu-item-row').forEach(row => {
            const cb = row.querySelector('.menu-checkbox');
            const qtyInput = row.querySelector('.menu-qty');
            
            if (cb && cb.checked) {
                hasSelection = true;
                qtyInput.disabled = false;
                qtyInput.classList.remove('bg-gray-50', 'text-gray-500');
                qtyInput.classList.add('bg-white', 'text-slate-800');

                const name = row.querySelector('.menu-name').innerText;
                const price = parseInt(row.querySelector('.menu-price-raw').getAttribute('data-price')) || 0;
                const qty = parseInt(qtyInput.value) || 1;

                const totalItemPrice = price * qty;
                subtotal += totalItemPrice;

                html += `
                <div class="flex justify-between text-sm gap-2">
                    <div class="max-w-[70%]">
                        <p class="font-bold text-slate-700 truncate">${name}</p>
                        <p class="text-[10px] text-gray-400">Pilihan Anda • <span>${qty}</span>x</p>
                    </div>
                    <span class="font-bold text-slate-800 whitespace-nowrap">${formatRupiah(totalItemPrice)}</span>
                </div>
                `;
            } else if (qtyInput) {
                qtyInput.disabled = true;
                qtyInput.classList.add('bg-gray-50', 'text-gray-500');
                qtyInput.classList.remove('bg-white', 'text-slate-800');
            }
        });

        if (!hasSelection) {
            html = '<div class="text-xs text-gray-400 italic text-center py-2">Belum ada menu yang dipilih</div>';
        }

        selectedMenusList.innerHTML = html;
        const appServiceFee = 2000; 
        summarySubtotal.innerText = formatRupiah(subtotal);
        summaryTax.innerText = formatRupiah(appServiceFee);
        summaryTotal.innerText = formatRupiah(subtotal + appServiceFee);
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', calculateTotal);
    });

    document.querySelectorAll('.menu-qty').forEach(qty => {
        qty.addEventListener('input', calculateTotal);
        qty.addEventListener('change', calculateTotal);
    });

    calculateTotal();
</script>
@endsection