@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
  <div class="flex flex-wrap items-center gap-3 mb-6">
    <h1 class="text-2xl font-semibold">Danh sách sách</h1>
  </div>
  @php
    $demoBooks = [
      ['id'=>1,'title'=>'Clean Code','author'=>'Robert C. Martin','price'=>180000],
      ['id'=>2,'title'=>'Laravel Up & Running','author'=>'Matt Stauffer','price'=>220000],
      ['id'=>3,'title'=>'You Don\'t Know JS','author'=>'Kyle Simpson','price'=>150000],
    ];
  @endphp
  <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-5">
    @foreach($demoBooks as $book)
      @include('components.product-card', ['book' => $book])
    @endforeach
  </div>
@endsection