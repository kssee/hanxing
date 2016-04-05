$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip({
        'placement': 'top'
    });

    if ( $( "#flash-overlay-modal" ).length ) {
        $('#flash-overlay-modal').modal();
    }

    if ( $( ".footable" ).length ) {
        $(function () {
            $('.footable').footable();
        });
    }

    if ( $( ".datepicker" ).length ) {
        $(function () {
            $('.datepicker').datetimepicker({
                format: "YYYY-MM-DD"
            });
        });
    }

    if ( $( ".timepicker" ).length ) {
        $(function () {
            $('.timepicker').datetimepicker({
                format: "HH:mm"
            });
        });
    }

    if ( $( ".iframe" ).length ) {
        @if(Agent::isDesktop())
            $(".iframe").colorbox({iframe:true, width:"80%", height:"94%", overlayClose:false, closeButton:true, escKey:false});
        @else
            $(".iframe").colorbox({iframe:true, width:"98%", height:"80%", overlayClose:false, closeButton:true, escKey:false});
        @endif
        }

    window.closeColorbox = function () {
        $.colorbox.close();
    };

    @if(session()->has('notie_flag'))
        notie.{{session('notie_type')}}({{session('notie_level')}}, '{{session('notie_message')}}', {{session('notie_second',2)}});
    @endif

    @yield('jsFunctions')
});