@extends('layouts.public')

@section('title', 'Smart Barangay - Home')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <h1 class="display-4 mb-4">Request Barangay Documents Online</h1>
            <p class="lead text-muted mb-4">Get your documents in 2-3 business days. No more long lines!</p>
            <div class="d-flex gap-3 justify-content-center">
                <button class="btn btn-primary btn-lg"><i class="bi bi-file-earmark-plus"></i> Request Document</button>
                <button class="btn btn-outline-primary btn-lg"><i class="bi bi-search"></i> Track Request</button>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 mb-3">🌐</div>
                    <h5 class="card-title">24/7 Access</h5>
                    <p class="card-text text-muted">Submit requests anytime, anywhere</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 mb-3">📱</div>
                    <h5 class="card-title">SMS Updates</h5>
                    <p class="card-text text-muted">Get notified via text message</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="display-4 mb-3">⚡</div>
                    <h5 class="card-title">Fast Processing</h5>
                    <p class="card-text text-muted">2-3 business days average</p>
                </div>
            </div>
        </div>
    </div>
@endsection
