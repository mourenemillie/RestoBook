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

        <form action="{{ route('restaurant.booking') }}" method="POST">
            @csrf
            
            {{-- Menggunakan data dinamis dari backend, fallback ke nama default jika objek kosong --}}
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id ?? 1 }}">
            <input type="hidden" name="restaurant_name" value="{{ $restaurant->name ?? 'Bakso Son Haji Sony' }}">

            <div class="flex flex-col lg:flex-row gap-8">
                
                {{-- KIRI: FORM RESERVASI --}}
                <div class="lg:w-2/3">
                    <span class="text-orange-600 font-bold uppercase tracking-widest text-xs">Detail Reservasi</span>
                    <h1 class="text-4xl font-black text-slate-900 mt-2 mb-4">Amankan Meja Anda di {{ $restaurant->name ?? 'Bakso Sony' }}</h1>
                    <p class="text-gray-500 mb-10">Nikmati cita rasa legendaris dengan kenyamanan ekstra. Isi detail di bawah ini untuk menyelesaikan pemesanan meja Anda.</p>

                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-slate-700 font-bold mb-3">Pilih Tanggal</label>
                                <div class="relative">
                                    <input type="date" name="booking_date" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-gray-600 focus:ring-2 focus:ring-orange-500 outline-none font-semibold" value="{{ old('booking_date', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-slate-700 font-bold mb-3">Jumlah Tamu</label>
                                <select name="number_of_people" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-gray-600 focus:ring-2 focus:ring-orange-500 outline-none appearance-none font-semibold" required>
                                    <option value="2" {{ old('number_of_people') == '2' ? 'selected' : '' }}>2 Orang</option>
                                    <option value="4" {{ old('number_of_people') == '4' ? 'selected' : '' }}>4 Orang</option>
                                    <option value="6" {{ old('number_of_people') == '6' ? 'selected' : '' }}>6 Orang</option>
                                    <option value="8" {{ old('number_of_people') == '8' ? 'selected' : '' }}>8 Orang</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-slate-700 font-bold mb-4">Pilihan Jam Kedatangan</label>
                            <input type="hidden" name="booking_time" id="selected_booking_time" value="{{ old('booking_time', '12:00') }}">
                            
                            <div class="flex flex-wrap gap-3">
                                @foreach(['10:00', '12:00', '14:00', '17:00', '19:00', '20:00'] as $time)
                                    <button type="button" class="time-btn px-6 py-3 rounded-2xl font-bold transition-all border-2 {{ old('booking_time', '12:00') == $time ? 'bg-orange-50 text-orange-600 border-orange-600' : 'bg-gray-50 text-gray-400 border-transparent hover:border-gray-200' }}" data-time="{{ $time }}">
                                        {{ $time }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-slate-700 font-bold">Pilihan Area Meja</label>
                                <span class="text-orange-600 text-xs font-bold uppercase cursor-pointer hover:underline">Lihat Denah Lokasi</span>
                            </div>
                            
                            <input type="hidden" name="table_area" id="selected_table_area" value="{{ old('table_area', 'Area Jendela (Meja 01)') }}">

                            <div class="relative rounded-[2rem] overflow-hidden h-64 bg-slate-200 border border-gray-100">
                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800" class="w-full h-full object-cover opacity-60" alt="Layout Restoran">
                                <div class="absolute inset-0 flex items-center justify-center gap-4 px-6">
                                    
                                    <button type="button" class="area-btn bg-orange-600 text-white p-4 rounded-2xl shadow-xl flex flex-col items-center min-w-[90px] border-2 border-white transform scale-110 transition-all duration-300" data-area="Area Jendela (Meja 01)">
                                        <span class="text-[10px] font-bold uppercase">Jendela</span>
                                        <span class="font-black text-lg">01</span>
                                    </button>
                                    
                                    <button type="button" class="area-btn bg-white/90 backdrop-blur text-slate-600 p-4 rounded-2xl flex flex-col items-center min-w-[90px] shadow-sm border-2 border-transparent transition-all duration-300 transform scale-100" data-area="Area Tengah (Meja 04)">
                                        <span class="text-[10px] font-bold uppercase">Tengah</span>
                                        <span class="font-black text-lg">04</span>
                                    </button>
                                    
                                    <button type="button" class="area-btn bg-white/90 backdrop-blur text-slate-600 p-4 rounded-2xl flex flex-col items-center min-w-[90px] shadow-sm border-2 border-transparent transition-all duration-300 transform scale-100" data-area="Area Lantai 2 (Meja 12)">
                                        <span class="text-[10px] font-bold uppercase">Lantai 2</span>
                                        <span class="font-black text-lg">12</span>
                                    </button>
                                    
                                </div>
                            </div>
                        </div>

                        {{-- SEKSI PILIH MENU --}}
                        <div class="mb-4">
                            <label class="block text-slate-700 font-bold mb-4">Pilih Menu Tambahan (Opsional)</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($restaurant->menus ?? [] as $menu)
                                    <div class="border border-gray-200 p-4 rounded-2xl flex items-center justify-between bg-white hover:border-orange-200 transition">
                                       <div>
                                          <label class="flex items-center gap-3 cursor-pointer">
                                              <input type="checkbox" name="menu_ids[]" value="{{ $menu->id }}" class="menu-checkbox w-5 h-5 text-orange-600 rounded border-gray-300 focus:ring-orange-500" data-price="{{ $menu->price }}" data-name="{{ $menu->name }}">
                                              <div>
                                                  <p class="font-bold text-slate-700">{{ $menu->name }}</p>
                                                  <p class="text-xs text-gray-500">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                              </div>
                                          </label>
                                       </div>
                                       <div class="flex items-center gap-2">
                                           <input type="number" name="menu_qty[{{ $menu->id }}]" min="1" value="1" class="w-14 border border-gray-200 rounded-lg p-1 text-center text-sm font-bold menu-qty bg-gray-50 text-gray-500" disabled>
                                       </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 col-span-2">Restoran ini belum memiliki menu yang bisa dipesan secara online.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN: RINGKASAN PESANAN (SIDEBAR) --}}
                <div class="lg:w-1/3">
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 sticky top-10">
                        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-50">
                            <div class="w-16 h-16 bg-slate-100 rounded-2xl overflow-hidden shadow-sm">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/28/Bakso_mi_bihun.jpg" class="w-full h-full object-cover" alt="Thumb">
                            </div>
                            <div>
                                <h3 class="font-black text-slate-800">{{ $restaurant->name ?? 'Bakso Son Haji Sony' }}</h3>
                                <p class="text-xs text-gray-400 font-medium">📍 {{ $restaurant->address ?? 'Wolter Monginsidi, Lampung' }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 bg-orange-50 text-orange-600 text-[10px] font-bold rounded-lg uppercase">Legendaris • Bakso</span>
                            </div>
                        </div>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-slate-800">Pesanan Menu</span>
                            </div>
                            
                            <div id="selected-menus-list" class="space-y-3">
                                <div class="text-xs text-gray-400 italic">Belum ada menu yang dipilih</div>
                            </div>
                        </div>

                        <div class="space-y-2 border-t border-gray-50 pt-6 mb-6">
                            <div class="flex justify-between text-sm text-gray-400 font-medium">
                                <span>Subtotal</span>
                                <span id="summary-subtotal">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-400 font-medium">
                                <span>Biaya Layanan (Pajak 10%)</span>
                                <span id="summary-tax">Rp 0</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-8">
                            <span class="font-black text-slate-800 text-lg">Estimasi Total</span>
                            <span class="font-black text-orange-600 text-2xl" id="summary-total">Rp 0</span>
                        </div>

                        <button type="submit" class="w-full bg-orange-600 text-white py-5 rounded-3xl font-black text-lg shadow-xl shadow-orange-100 hover:bg-orange-700 transition-all flex items-center justify-center gap-3 transform hover:-translate-y-1">
                            Lanjut ke Pembayaran 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>

                        <div class="mt-6 flex items-start gap-3 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <div class="bg-orange-100 p-2 rounded-xl text-lg">🛡️</div>
                            <div>
                                <p class="text-[11px] font-bold text-slate-800 uppercase tracking-wider">Booking Aman</p>
                                <p class="text-[10px] text-gray-400 leading-relaxed">Data pembayaran Anda dienkripsi secara otomatis dan aman.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    // 1. Logika Pemilihan Jam Kedatangan
    document.querySelectorAll('.time-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.time-btn').forEach(b => {
                b.className = "time-btn px-6 py-3 rounded-2xl font-bold transition-all border-2 bg-gray-50 text-gray-400 border-transparent hover:border-gray-200";
            });
            this.className = "time-btn px-6 py-3 rounded-2xl font-bold transition-all border-2 bg-orange-50 text-orange-600 border-orange-600";
            document.getElementById('selected_booking_time').value = this.getAttribute('data-time');
        });
    });

    // 2. Logika Pemilihan Nomor/Area Meja (Diselaraskan Scale & Shadow Efeknya)
    document.querySelectorAll('.area-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.area-btn').forEach(b => {
                b.className = "area-btn bg-white/90 backdrop-blur text-slate-600 p-4 rounded-2xl flex flex-col items-center min-w-[90px] shadow-sm border-2 border-transparent transition-all duration-300 transform scale-100";
            });
            this.className = "area-btn bg-orange-600 text-white p-4 rounded-2xl shadow-xl flex flex-col items-center min-w-[90px] border-2 border-white transform scale-110 transition-all duration-300";
            document.getElementById('selected_table_area').value = this.getAttribute('data-area');
        });
    });

    // 3. Logika Update Harga Dinamis Berdasarkan Jumlah Tamu
    const guestSelect = document.querySelector('select[name="number_of_people"]');
    if (guestSelect) {
        guestSelect.addEventListener('change', function() {
            calculateTotal();
        });
    }

    // 4. Kalkulasi Menu Dinamis
    const checkboxes = document.querySelectorAll('.menu-checkbox');
    const selectedMenusList = document.getElementById('selected-menus-list');
    const summarySubtotal = document.getElementById('summary-subtotal');
    const summaryTax = document.getElementById('summary-tax');
    const summaryTotal = document.getElementById('summary-total');

    function formatRupiah(number) {
        return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function calculateTotal() {
        let subtotal = 0;
        let html = '';
        let hasSelection = false;

        checkboxes.forEach(cb => {
            const qtyInput = cb.closest('.border').querySelector('.menu-qty');
            if (cb.checked) {
                hasSelection = true;
                qtyInput.disabled = false;
                qtyInput.classList.remove('bg-gray-50', 'text-gray-500');
                qtyInput.classList.add('bg-white', 'text-slate-800');
                
                const price = parseInt(cb.getAttribute('data-price'));
                const qty = parseInt(qtyInput.value) || 1;
                const name = cb.getAttribute('data-name');
                const totalItemPrice = price * qty;
                subtotal += totalItemPrice;

                html += `
                <div class="flex justify-between text-sm">
                    <div>
                        <p class="font-bold text-slate-700">${name}</p>
                        <p class="text-[10px] text-gray-400">Pilihan Anda • <span>${qty}</span>x</p>
                    </div>
                    <span class="font-bold text-slate-800">${formatRupiah(totalItemPrice)}</span>
                </div>
                `;
            } else {
                qtyInput.disabled = true;
                qtyInput.classList.add('bg-gray-50', 'text-gray-500');
                qtyInput.classList.remove('bg-white', 'text-slate-800');
            }
        });

        if (!hasSelection) {
            html = '<div class="text-xs text-gray-400 italic">Belum ada menu yang dipilih</div>';
        }

        selectedMenusList.innerHTML = html;
        const tax = Math.round(subtotal * 0.1); // 10% tax
        summarySubtotal.innerText = formatRupiah(subtotal);
        summaryTax.innerText = formatRupiah(tax);
        summaryTotal.innerText = formatRupiah(subtotal + tax);
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', calculateTotal);
    });

    document.querySelectorAll('.menu-qty').forEach(qty => {
        qty.addEventListener('input', calculateTotal);
        qty.addEventListener('change', calculateTotal);
    });
    
    // Initial calculate
    calculateTotal();
</script>
@endsection