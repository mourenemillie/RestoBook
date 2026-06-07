@extends('layouts.dashboard')

@section('title', 'Reservasi')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/style-reservasi.css') }}">
@endsection

@section('content')

<main class="main-content">

    {{-- NOTIF --}}
    @if(session('success'))
        <div style="background:#d4edda; padding:10px; margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <header class="arrivals-header">
        <div class="header-text">
            <h1>Arrivals</h1>
            <p>Manage today's reservations and check-ins.</p>
        </div>
        
        <div class="filter-tabs">
            <button class="tab active">All</button>
            <button class="tab">Waiting</button>
            <button class="tab">Arrived</button>
            <button class="tab">No-Show</button>
        </div>
    </header>

    <section class="arrivals-list">
        
        {{-- CARD 1 --}}
        <div class="arrival-card">
            <div class="arrival-time">18:30</div>

            <div class="arrival-info">
                <h3>Budi Santoso</h3>
                <div class="arrival-tags">
                    <span class="tag-item"><i data-lucide="table"></i> Table 04</span>
                    <span class="tag-item"><i data-lucide="users"></i> 4 Guests</span>
                </div>
            </div>

            <div class="arrival-actions">
                <form action="{{ route('owner.reservasi.noshow') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <button type="submit" class="btn-outline">Mark No-Show</button>
                </form>

                <form action="{{ route('owner.reservasi.checkin') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="1">
                    <button type="submit" class="btn-filled">Check-In</button>
                </form>
            </div>
        </div>

        {{-- CARD 2 --}}
        <div class="arrival-card">
            <div class="arrival-time">19:00</div>

            <div class="arrival-info">
                <h3>Siti Aminah</h3>
                <div class="arrival-tags">
                    <span class="tag-item"><i data-lucide="table"></i> Table 12</span>
                    <span class="tag-item"><i data-lucide="users"></i> 2 Guests</span>
                </div>
            </div>

            <div class="arrival-actions">
                <form action="{{ route('owner.reservasi.noshow') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="2">
                    <button type="submit" class="btn-outline">Mark No-Show</button>
                </form>

                <form action="{{ route('owner.reservasi.checkin') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="2">
                    <button type="submit" class="btn-filled">Check-In</button>
                </form>
            </div>
        </div>

    </section>

</main>

@endsection