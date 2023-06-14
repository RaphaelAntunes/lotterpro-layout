<div class="row">
    <div class="col-md-12">
        @error('success')
        @push('scripts')
            <script>
                toastr["success"]("{{ $message }}")
            </script>
        @endpush
        @enderror
        @error('error')
        @push('scripts')
            <script>
                toastr["error"]("{{ $message }}")
            </script>
        @endpush
        @enderror
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">{{ trans('admin.pagesF.permissao') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">{{ trans('admin.pagesF.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" placeholder="Ex: create_user"
                                   maxlength="50" value="{{ $permission->name ?? null }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">{{ trans('admin.pagesF.arvoreMenu') }}</label>
                            <input type="text" class="form-control @error('menu') is-invalid @enderror"
                                   id="menu" name="menu" placeholder="Ex: configurações/usuários"
                                   maxlength="50" value="{{ $permission->menu ?? null }}">
                            @error('menu')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alias">{{ trans('admin.pagesF.nameVisivel') }}</label>
                            <input type="text" class="form-control @error('alias') is-invalid @enderror"
                                   id="alias" name="alias" placeholder="Ex: Cadastrar Usuário"
                                   maxlength="50" value="{{ $permission->alias ?? null }}">
                            @error('alias')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <a href="{{route('admin.settings.permissions.index')}}">
            <button type="button" class="btn btn-block btn-info">{{ trans('admin.pagesF.voltTela') }}</button>
        </a>
    </div>
    <div class="col-md-6 mb-3">
        <button type="submit"
                class="btn btn-block btn-success">@if(request()->is('admin/settings/permissions/create'))
                {{ trans('admin.pagesF.cadastPerm') }}  @else  {{ trans('admin.pagesF.atualPerm') }} @endif </button>
    </div>
</div>
