@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')

<h1>Dashboard</h1>

<p>
    Selamat datang,
    {{ auth()->user()->name }}
</p>

<div class="cards">

    <div class="card">

        <div class="card-title">
            Total Data Penilaian
        </div>

        <div class="card-number">
            {{ $totalPenilaian }}
        </div>

    </div>

</div>

@endsection