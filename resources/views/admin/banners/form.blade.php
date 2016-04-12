<div class="form-group">
    {!! Form::label('title',trans('custom.title'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('title',old('title'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description',trans('custom.description'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('description',old('description'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('url',trans('custom.url'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('url',old('url'),['class'=>'form-control input-sm','placeholder'=>'http(s)://'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('published',trans('custom.publish') . ' ?',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        <label>{!! Form::radio('published',1,true)!!} Yes</label> &nbsp; <label>{!! Form::radio('published',0)!!} No</label>
    </div>
</div>

@if(isset($result->path))
    <div class="form-group">
        <div class="col-sm-3 text-right"><label>Current Image</label></div>
        <div class="col-sm-9">
            <img src="{{ asset($result->path) }}" class="responsive-image" />
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('image','Image (1320px X 385px)',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::file('image',['class'=>'form-control input-sm input-required'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-7">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.banner.index',trans('custom.cancel'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>