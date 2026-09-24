@extends('layouts.app')

@section('title', 'Dashboard Viewer')

@section('content')

<h1>Dashboard Viewer</h1>

<p>
    Mode hanya melihat data.
</p>

<div class="cards">

    <div class="card">

        <div class="card-title">
            Total Penilaian
        </div>

        <div class="card-number">
            {{ $totalPenilaian }}
        </div>

    </div>

</div>

@endsection