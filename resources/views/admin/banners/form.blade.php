<div class="form-group">
    {!! Form::label('slug',trans('custom.slug'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('slug',old('slug'),['class'=>'form-control input-sm input-required','required'=>'required'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('title',trans('custom.title'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::text('title',old('title'),['class'=>'form-control input-sm'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('category',trans('custom.category'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">{!! Form::select('category', $categoryArr , null,['class'=>'form-control input-sm input-required'])!!}</div>
</div>

<div class="form-group">
    {!! Form::label('published',trans('custom.publish') . ' ?',['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        <label>{!! Form::radio('published',1)!!} Yes</label> &nbsp; <label>{!! Form::radio('published',0)!!} No</label>
    </div>
</div>

<div class="form-group">
    {!! Form::label('highlight',trans('custom.highlight'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('highlight',old('highlight'),['class'=>'form-control input-sm','rows'=>'3'])!!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('content',trans('custom.content'),['class'=>'control-label col-sm-2']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('page_content',old('page_content'),['class'=>'form-control input-sm input-required','required'=>'required','id'=>'editor'])!!}
    </div>
</div>

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