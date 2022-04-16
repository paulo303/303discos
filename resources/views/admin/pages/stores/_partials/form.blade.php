<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nome da Loja" value="{{ $store->name ?? old('name') }}">
            @if ($errors->has('name'))
                <div class="error">{!! $errors->first('name') !!}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" name="link" placeholder="Link" value="{{ $store->link ?? old('link') }}">
            @if ($errors->has('link'))
                <div class="error">{!! $errors->first('link') !!}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="logo">Logo</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="logo" name="logo" value="{{ old('logo') }}">
                    <label class="custom-file-label" for="logo">Escolher arquivo</label>
                </div>
            </div>
            @if ($errors->has('logo'))
                <div class="error">{!! $errors->first('logo') !!}</div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</div>
