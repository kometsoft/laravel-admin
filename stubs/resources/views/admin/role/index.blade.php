@extends(config('tabler.layout'))

@section('header')
<x-tabler::page-header title="Access Control">
    <div class="btn-list">
        <x-tabler::button :href="route('tabler.admin.role.create')" class="btn btn-primary" icon="plus" label="Create"></x-tabler::button>
    </div>
</x-page-header>
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