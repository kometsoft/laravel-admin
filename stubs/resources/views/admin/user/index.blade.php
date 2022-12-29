@extends(config('laravel-auth.layout'))

@section('header')
<x-tab::page-header title="Users">
    <div class="btn-list">
        <x-tab::button :href="route('admin.user.create')" class="btn btn-primary" icon="plus" label="Create"></x-tab::button>
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