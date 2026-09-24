@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="topbar">

    <div>

        <h1>Dashboard Admin</h1>

        <p>
            Selamat datang,
            {{ auth()->user()->name }}
        </p>

    </div>

</div>

<div class="cards">

    <div class="card">

        <div class="card-title">
            Total Penilaian
        </div>

        <div class="card-number">
            {{ $totalPenilaian }}
        </div>

    </div>


    <div class="card">

        <div class="card-title">
            Selesai
        </div>

        <div class="card-number">
            {{ $selesai }}
        </div>

    </div>


    <div class="card">

        <div class="card-title">
            Draft
        </div>

        <div class="card-number">
            {{ $draft }}
        </div>

    </div>

</div>

@endsection