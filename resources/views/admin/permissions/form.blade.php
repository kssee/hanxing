<div class="form-group">
    {!! Form::label('name',trans('custom.name'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('name',old('name'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('display_name',trans('custom.display_name'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('display_name',old('display_name'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description',trans('custom.description'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('description',old('description'),['class'=>'form-control input-sm','placeholder'=>'Optional'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-7">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.permission.index',trans('custom.cancel'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>