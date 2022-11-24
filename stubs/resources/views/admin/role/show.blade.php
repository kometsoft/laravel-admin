@extends(config('tabler.layout'))

@section('header')
<x-tabler::page-header :title='"$role->name"' :links="[
    ['route' => route('tabler.admin.role.index'), 'name' => __('Roles')],
]">
    <div class="btn-list">
        <x-tabler::button :href="route('tabler.admin.role.edit', $role)" class="btn btn-primary" icon="pencil" label="Edit"></x-tabler::button>
    </div>
</x-page-header>
@endsection

@section('content')

<div class="row row-cards">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-role-edit"
                    action="{{ $role->exists ? route('tabler.admin.role.update', $role) : route('tabler.admin.role.store') }}"
                    method="POST">
                    @csrf

                    <div class="form-group mb-3 row">
                        <x-tabler::label class="col-md-3 col-form-label" label="Name"></x-tabler::label>
                        <div class="col-md-6">
                            <p class="form-control-plaintext">{{ $role->name }}</p>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <x-tabler::label class="col-md-3 col-form-label" label="Roles"></x-tabler::label>
                        <div class="col-md-6">
                            @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                    value="{{ $permission->id }}" id="permission-{{ $permission->id }}"
                                    @checked($role->hasAnyPermission($permission->name)) disabled>
                                <label class="form-check-label opacity-100" for="permission-{{ $permission->id }}">{{
                                    $permission->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection