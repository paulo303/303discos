<div class="card">
    <div class="card-body">
        <div class="form-group">
            <label for="name">Selo</label>
            <select name="label_id" id="label_id" class="form-control">
                @foreach ($selos as $selo)
                    <option value="{{ $selo->id }}"
                        @if(isset($release) && $selo->id == $release->label_id)
                            selected
                        @endif>
                        {{ $selo->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('label'))
                <div class="error">{!! $errors->first('label') !!}</div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="release_num">Release Number</label>
                    <input type="text" class="form-control" id="release_num" name="release_num" placeholder="Release Number" value="{{ $release->release_num ?? old('release_num') }}">
                    @if ($errors->has('release_num'))
                        <div class="error">{!! $errors->first('release_num') !!}</div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cat_num">Cat Number</label>
                    <input type="text" class="form-control" id="cat_num" name="cat_num" placeholder="Cat Number" value="{{ $release->cat_num ?? old('cat_num') }}">
                    @if ($errors->has('cat_num'))
                        <div class="error">{!! $errors->first('cat_num') !!}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="image">Imagem</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" value="{{ old('image') }}">
                    <label class="custom-file-label" for="image">Escolher arquivo</label>
                </div>
            </div>
            @if ($errors->has('image'))
                <div class="error">{!! $errors->first('image') !!}</div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-save"></i> Salvar
        </button>
    </div>
</div>
