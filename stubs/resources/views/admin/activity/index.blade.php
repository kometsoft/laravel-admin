@extends(config('tabler.layout'))

@section('header')
<x-tabler::page-header title="Activity Logs"></x-tabler::page-header>
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-md-12">
        {{ $dataTable->table() }}
    </div>
</div>
@endsection

@push('script')
{{ $dataTable->scripts() }}
@endpush