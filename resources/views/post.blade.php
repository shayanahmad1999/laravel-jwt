@extends('layout.app')
@section('content')
@section('title', 'Posts')
@push('style')
<style>
  .post {
      border: 1px solid #ddd;
      padding: 10px;
      margin-bottom: 10px;
  }
  .post-title {
      font-weight: bold;
  }
  .post-content {
      margin-top: 5px;
  }
</style>
@endpush
<h1 class="text-3xl font-semibold mb-4">Post show will here of logged user</h1>
<div id="posts"></div>
@push('script')
      <script src="{{ asset('assets/js/fetch.js') }}"></script>
  @endpush
@endsection