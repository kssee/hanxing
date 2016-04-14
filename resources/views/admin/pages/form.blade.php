<div class="form-group">
    {!! Form::label('title',trans('custom.title'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('title',old('title'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('title_zh',trans('custom.chinese_name'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('title_zh',old('title_zh'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('category',trans('custom.category'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">{!! Form::select('category', $categoryArr , NULL,['class'=>'form-control input-sm input-required'])!!}</div>
</div>

<div class="form-group">
    {!! Form::label('published',trans('custom.publish') . ' ?',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <label>{!! Form::radio('published',1,true)!!} Yes</label> &nbsp; <label>{!! Form::radio('published',0)!!} No</label>
    </div>
</div>

@if(isset($result->path_banner))
    <div class="form-group">
        <div class="col-sm-2 text-right"><label>Current Banner</label></div>
        <div class="col-sm-10">
            <img src="{{ asset($result->path_banner) }}" class="responsive-image"/>
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('image','Banner (1500 X 300)',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::file('image',['class'=>'form-control input-sm input-required'])!!}
    </div>
</div>

@if(isset($result->path_thumbnail))
    <div class="form-group">
        <div class="col-sm-2 text-right"><label>Current Thumbnail</label></div>
        <div class="col-sm-10">
            <img src="{{ asset($result->path_thumbnail) }}" width="150px"/>
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('thumbnail','Thumbnail (300 X 120)',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::file('thumbnail',['class'=>'form-control input-sm input-required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('highlight',trans('custom.highlight'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('highlight',old('highlight'),['class'=>'form-control input-sm','rows'=>'3'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('content',trans('custom.content'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('page_content',old('page_content'),['class'=>'form-control input-sm input-required','required'=>'required','id'=>'editor'])!!}
    </div>
</div>

<hr/>

<div class="form-group">
    {!! Form::label('child_display_category',trans('custom.child_display_category'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">{!! Form::select('child_display_category', $childDisplayArr , NULL,['class'=>'form-control input-sm input-required'])!!}</div>
</div>

<div class="form-group">
    {!! Form::label('child_page_id',trans('custom.child_page'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">{!! Form::select('child_page_id[]', $pagesArr , NULL,['class'=>'form-control input-sm input-required multi-select','multiple'=>'multiple'])!!}</div>
</div>

<hr/>
<div class="form-group">
    {!! Form::label('popup_page_id',trans('custom.popup_page'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">{!! Form::select('popup_page_id', $pagesArr , NULL,['class'=>'form-control input-sm input-required'])!!}</div>
</div>
<div class="form-group">
    {!! Form::label('popup_title',trans('custom.popup_page_title'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('popup_title',old('popup_title'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('popup_title_zh',trans('custom.popup_page_chinese_name'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('popup_title_zh',old('popup_title_zh'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<hr/>

<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">{!! Form::submit($type == 'create' ? trans('custom.create') : trans('custom.edit'),['class'=>'btn btn-primary btn-block'])!!}</div>
    <div class="col-sm-2">{!! link_to_route('admin.page.index',trans('custom.cancel'),[],['class'=>'btn btn-block btn-danger']) !!}</div>
</div>


<script src="{{ asset('ckeditor/ckeditor.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
        CKEDITOR.tools.enableHtml5Elements(document);

    CKEDITOR.config.height = 350;
    CKEDITOR.config.width = 'auto';

    var initCkeditor = (function () {
        var wysiwygareaAvailable = isWysiwygareaAvailable(),
                isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

        return function () {
            var editorElement = CKEDITOR.document.getById('editor');

            if (isBBCodeBuiltIn) {
                editorElement.setHtml(
                        ''
                );
            }
            if (wysiwygareaAvailable) {
                CKEDITOR.replace('editor', {

                    filebrowserBrowseUrl: '/elfinder/ckeditor'
                });
            } else {
                editorElement.setAttribute('contenteditable', 'true');
                CKEDITOR.inline('editor');
            }
        };

        function isWysiwygareaAvailable() {
            if (CKEDITOR.revision == ( '%RE' + 'V%' )) {
                return true;
            }

            return !!CKEDITOR.plugins.get('wysiwygarea');
        }
    })();
</script>

<script>initCkeditor();</script>