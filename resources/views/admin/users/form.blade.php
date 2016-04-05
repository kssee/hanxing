@if($type == 'create')
    <div class="form-group">
        {!! Form::label('email',trans('custom.email'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('email',old('email'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
        </div>
    </div>
@else
    <div class="form-group">
        {!! Form::label('email',trans('custom.email'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('email',old('email'),['class'=>'form-control input-sm','readonly'=>'readonly'])!!}
        </div>
    </div>
@endif

@if(! (isset($user) && auth()->user()->id == $user->id))
    <div class="form-group">
        {!! Form::label('status',trans('custom.status'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">{!! Form::select('status', ['ACTIVE'=>'Active','SUSPEND'=>'Suspend'] , 'ACTIVE',['class'=>'form-control input-sm input-required'])!!}</div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('password',trans('custom.password'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::password('password',['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password_confirmation',trans('custom.confirm_password'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::password('password_confirmation',['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name',trans('custom.name'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('name',old('name'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
    </div>
</div>

@if(! (isset($user) && auth()->user()->id == $user->id))
    <div class="form-group">
        {!! Form::label('role',trans('custom.role'),['class'=>'control-label col-sm-3']) !!}
        <div class="col-sm-9">{!! Form::select('role', $roleArr , isset($user_role_id) ? $user_role_id : NULL,['class'=>'form-control input-sm input-required'])!!}</div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('position',trans('custom.position'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('position',old('position'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('tel',trans('custom.contact_no'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('tel',old('tel'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ext',trans('custom.ext'),['class'=>'control-label col-sm-3']) !!}
    <div class="col-sm-9">
        {!! Form::text('ext',old('ext'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-7">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.user.index',trans('custom.back'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>