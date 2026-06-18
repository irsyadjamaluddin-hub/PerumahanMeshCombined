@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">QR Code</div>

                <div class="card-body text-center">
                    <img src="{{ asset('storage/' . $filename) }}" alt="QR Code">
                    <br>
                    <a href="{{ route('download-qr-code', ['id' => $id]) }}" class="btn btn-primary mt-3">Download QR Code</a>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
