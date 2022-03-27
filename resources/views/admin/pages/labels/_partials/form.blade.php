@include('admin/includes/alerts')

<div class="card-header">
    <h3 class="card-title">Quick Example</h3>
</div>
<div class="card-body">
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do selo" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label for="url">URL</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="URL" value="{{ old('url') }}">
    </div>
    <div class="form-group">
        <label for="logo">Logo</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="logo" name="logo" value="{{ old('logo') }}">
                <label class="custom-file-label" for="logo">Escolher arquivo</label>
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>
