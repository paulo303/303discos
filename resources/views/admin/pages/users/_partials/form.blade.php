<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo" value="{{ $user->name ?? old('name') }}">
            @if ($errors->has('name'))
                <div class="error">{!! $errors->first('name') !!}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{{ $user->email ?? old('email') }}">
            @if ($errors->has('email'))
                <div class="error">{!! $errors->first('email') !!}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Senha" value="">
            @if ($errors->has('password'))
                <div class="error">{!! $errors->first('password') !!}</div>
            @endif
        </div>
        {{-- <div class="form-group">
            <label for="user_type_id">Tipo de usuário</label>
            <select name="user_type_id" id="user_type_id" class="form-control">
                @foreach ($userTypes as $userType)
                    <option value="{{ $userType->id }}" @if (isset($user) && $userType->id == $user->user_type_id) selected @endif>{{ $userType->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('user_type_id'))
                <div class="error">{!! $errors->first('user_type_id') !!}</div>
            @endif
        </div> --}}
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</div>
