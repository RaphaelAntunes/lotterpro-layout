@extends('admin.layouts.master')

@section('title', 'Extrato Financeiro')

@section('content')
    <div class="row  p-3">
        <div class="col-md-12">
            @livewire('pages.dashboards.extract.new-extract')
        </div>
    </div>
@endsection

@push('scripts')
@endpush