<div class="form-group">
    {!! Form::label('title',trans('custom.title'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('title',old('title'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('category',trans('custom.category'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">{!! Form::select('category', $categoryArr , null,['class'=>'form-control input-sm input-required'])!!}</div>
</div>

<div class="form-group">
    {!! Form::label('subcategory',trans('custom.subcategory'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('subcategory',old('subcategory'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('subcategory_zh',trans('custom.subcategory_zh'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('subcategory_zh',old('subcategory_zh'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('link',trans('custom.link'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('link',old('link'),['class'=>'form-control input-sm','placeholder'=>'http(s)://'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('author',trans('custom.author'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('author',old('author'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('published',trans('custom.publish') . ' ?',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        <label>{!! Form::radio('published',1,true)!!} Yes</label> &nbsp; <label>{!! Form::radio('published',0)!!} No</label>
    </div>
</div>

@if(isset($result->path_file))
    <div class="form-group">
        <div class="col-sm-3 text-right"></div>
        <div class="col-sm-9">
            {!! link_to(asset($result->path_file),'view current pdf file',['target'=>'_blank']) !!}
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('pdf_file','pdf File',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::file('pdf_file',['class'=>'form-control input-sm input-required'])!!}
    </div>
</div>

@if(isset($result->path_thumbnail))
    <div class="form-group">
        <div class="col-sm-3 text-right"><label>Current Thumbnail</label></div>
        <div class="col-sm-9">
            <img src="{{ asset($result->path_thumbnail) }}" width="100px" />
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('image','Image (300 X 200) or (300 X 425)',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::file('image',['class'=>'form-control input-sm input-required'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-7">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.sshowcase.index',trans('custom.cancel'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>