<div class='btn-group' role='group'>
    <button type='button' class='btn btn-xs btn-warning dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>{{trans('custom.common.export_in')}}&nbsp;<span class='caret'></span></button>
    <ul class='dropdown-menu'>
        <li>{!! link_to_route($route,'Excel 2007 (xlsx)',array_add($params, 'format', 'xlsx'))!!}</li>
        <li>{!! link_to_route($route,'Excel 5 (xls)',array_add($params, 'format', 'xls'))!!}</li>
        <li>{!! link_to_route($route,'CSV',array_add($params, 'format', 'csv'))!!}</li>
    </ul>
</div>