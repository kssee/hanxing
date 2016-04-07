<table width="80%" align="center">
    <tr>
        <td align="right"><b>{{trans('custom.name')}}</b> : </td>
        <td>{{$name}}</td>
    </tr>
    <tr>
        <td align="right"><b>{{trans('custom.email')}}</b> : </td>
        <td>{{$email}}</td>
    </tr>
    <tr>
        <td align="right"><b>{{trans('custom.contact_no')}}</b> : </td>
        <td>{{$contact_no}}</td>
    </tr>
    <tr>
        <td align="right"><b>{{trans('custom.nature')}}</b> : </td>
        <td>{{$nature}}</td>
    </tr>
    <tr>
        <td align="right" valign="top"><b>{{trans('custom.enquiry')}}</b> : </td>
        <td>{!! nl2br($enquiry_message)!!}</td>
    </tr>
</table>