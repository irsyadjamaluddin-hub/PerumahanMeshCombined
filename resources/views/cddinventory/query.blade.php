@extends('layouts.app-all')

@section('title', 'Inventory Query Details')

@section('content')

<div class="pagetitle">
  <h1>Inventory Query Details</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('cddinventory.cddinventory.index') }}">Inventory</a></li>
      <li class="breadcrumb-item active">Query Details</li>
    </ol>
  </nav>
</div>

<section class="section profile">
  <div class="card">
    <div class="card-body">

      <h5>Inventory ID: {{ $inventory->id }}</h5>
      <p><strong>School Name:</strong> {{ $inventory->nama_sch }}</p>
      <p><strong>Created At:</strong> {{ $inventory->created_at }}</p>
      <p><strong>Other Info:</strong> <!-- Add other fields you want to show here --></p>

      <!-- Example: show related BBK records if you want -->
      @if(isset($inventorybbk) && isset($inventorybbk[$inventory->id]))
        <h6>Related BBK Records:</h6>
        <ul>
          @foreach($inventorybbk[$inventory->id] as $bbk)
            <li>ID: {{ $bbk->id }} — Status: {{ $bbk->cdd_status ?? 'N/A' }}</li>
          @endforeach
        </ul>
      @endif

      <!-- Add back button -->
      <a href="{{ route('cddinventory.cddinventory.index') }}" class="btn btn-secondary mt-3">Back to Inventory List</a>

    </div>
  </div>
</section>

@endsection
