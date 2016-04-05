<div class="form-group">
    {!! Form::label('name',trans('custom.name'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('name',old('name'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name_zh',trans('custom.chinese_name'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('name_zh',old('name_zh'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('path',trans('custom.path'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        http://{{$_SERVER['HTTP_HOST']}}/ {!! Form::text('path',old('path'),['class'=>'input-sm input-required','required'=>'required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('parent_id',trans('custom.parent'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">{!! Form::select('parent_id', $menuLists , NULL,['class'=>'form-control input-sm input-required'])!!}</div>
</div>

<div class="form-group">
    {!! Form::label('active_id',trans('custom.active_target'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">{!! Form::select('active_id', $activeLists , NULL,['class'=>'form-control input-sm input-required'])!!}</div>
</div>

<div class="form-group">
    {!! Form::label('layer',trans('custom.layer'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        <label>{!! Form::radio('layer',1,true)!!} First Layer</label> &nbsp; <label>{!! Form::radio('layer',2)!!} Second Layer</label> &nbsp; <label>{!! Form::radio('layer',3)!!} Third Layer (Will not
            display on nav bar)</label>
    </div>
</div>

<div class="form-group">
    {!! Form::label('order',trans('custom.order') . ' (For first layer only)',['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('order',old('order'),['class'=>'form-control input-sm'])!!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-7">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.menu.index',trans('custom.cancel'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>