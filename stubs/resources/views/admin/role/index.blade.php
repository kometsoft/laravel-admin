@extends(config('laravel-auth.layout'))

@section('header')
<x-tab::page-header title="Access Control">
    <div class="btn-list">
        <x-tab::button :href="route('admin.role.create')" class="btn btn-primary" icon="plus" label="Create"></x-tab::button>
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