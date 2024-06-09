@extends('layout.app')
@section('content')
@section('title', 'Dashboard')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-4">Welcome to the Dashboard</h1>
        <div id="userInfo" class="text-lg"></div>
    </div>
    @push('script')
        <script src="{{ asset('assets/js/fetch.js') }}"></script>
    @endpush
@endsection