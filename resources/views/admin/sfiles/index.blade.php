@extends('layouts.admin')
@section('jsFunctions')
@stop

@section('content')
    @include('flash::message')
    {!! filterBar($filter_list)!!}
    @if(count($result))
        <table class="table table-striped footable toggle-square">
            <thead>
            <tr>
                <th width="20px"></th>
                <th width="80px"></th>
                <th width="150px">{!!sortingLink(trans('custom.created_date'),'a','desc')!!}</th>
                <th>{{trans('custom.category')}}</th>
                <th>{!!sortingLink(trans('custom.title'),'b')!!}</th>
                <th>{{trans('custom.file')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($result as $entry)
                <tr>
                    <td></td>
                    <td>
                        @if($entry->published == '1')
                            <i class="fa fa-circle fa-lg color-success"></i>&nbsp;
                        @else
                            <i class="fa fa-circle fa-lg color-danger"></i>&nbsp;
                        @endif

                        {!! iconLinkWithPermission('admin_student_files','admin.sfiles.edit','fa-pencil-square-o',trans('custom.edit'),['sfiles'=>$entry->id]) !!}
                        @if(!$entry->default)
                            {!! iconLinkWithPermission('admin_student_files','admin.sfiles.destroy','fa-trash color-danger',trans('custom.delete'),['sfiles'=>$entry->id],[],true) !!}
                        @endif
                    </td>
                    <td>{{ $entry->created_at->toFormattedDateString() }}</td>
                    <td>{{ $categoryArr[$entry->category] }}</td>
                    <td>{{ $entry->title }}</td>
                    <td>
                        @if(!is_null($entry->path_file))
                            {!! link_to_route('studentFileView','download uploaded file',['id'=>$entry->id],['target'=>'_blank']) !!}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p class="no-record">{{trans('custom.no_record')}}</p>
    @endif

    @if(isset($paginate_appends))
        {!! $result->appends($paginate_appends)->render() !!}
    @else
        {!! $result->render() !!}
    @endif
@stop