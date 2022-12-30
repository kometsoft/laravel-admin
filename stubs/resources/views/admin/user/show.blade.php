@extends(config('laravel-auth.layout.app'))

@section('header')
<x-tab::page-header :title='"$user->name"' :links="[
    ['route' => route('admin.user.index'), 'name' => __('Users')],
]">
    <div class="btn-list">
        <x-tab::button :href="route('admin.user.edit', $user)" class="btn btn-primary" icon="pencil" label="Edit"></x-tab::button>
    </div>
</x-page-header>
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-user-edit"
                    action="{{ $user->exists ? route('admin.user.update', $user) : route('admin.user.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Name"></x-tab::label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $user->name }}</p>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Email"></x-tab::label>
                        <div class="col-md-9">
                            <p class="form-control-plaintext">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <x-tab::label class="col-md-3 col-form-label" label="Roles"></x-tab::label>
                        <div class="col-md-6">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection