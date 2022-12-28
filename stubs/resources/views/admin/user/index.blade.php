@extends(config('tabler.layout'))

@section('header')
<x-tabler::page-header title="Users">
    <div class="btn-list">
        <x-tabler::button :href="route('admin.user.create')" class="btn btn-primary" icon="plus" label="Create"></x-tabler::button>
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