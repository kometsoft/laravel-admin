@extends(config('laravel-auth.layout.app'))

@section('header')
<x-tab::page-header title="Activity Logs"></x-tab::page-header>
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            {{ $dataTable->table() }}
        </div>
    </div>
</div>
@endsection

@vite(['resources/js/datatables/app.js'])
@push('script')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush