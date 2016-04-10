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
    {!! Form::label('published',trans('custom.publish') . ' ?',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        <label>{!! Form::radio('published',1,true)!!} Yes</label> &nbsp; <label>{!! Form::radio('published',0)!!} No</label>
    </div>
</div>

@if(isset($result->path_file))
    <div class="form-group">
        <div class="col-sm-3 text-right"></div>
        <div class="col-sm-9">
            {!! link_to_route('studentFileView','download current file',['id'=>$result->id],['target'=>'_blank']) !!}
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('file',trans('custom.file') . ' (Max : 20 MB)',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::file('file',['class'=>'form-control input-sm input-required'])!!}
        <small class="color-primary">File type : jpeg, jpg, png, gif, pdf, docx, doc, txt, xlsx, xls, csv, zip</small>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-7">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.sfiles.index',trans('custom.cancel'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>