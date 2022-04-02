<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" style="color: white;" data-dismiss="alert" aria-hidden="true">x</button>
    <h5>
        <i class="icon fas fa-ban"></i> Atenção!
    </h5>
    @foreach ($errors->all() as $error)
        {!! $error !!} <br>
    @endforeach
</div>
