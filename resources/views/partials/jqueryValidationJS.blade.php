jQuery.validator.setDefaults({

submitHandler: function(form) {
$(form).find('input[type=submit]').prop("disabled", true);
$(form).find('input[type=submit]').val("{{trans('custom.form_submitting_message')}}");
$("body").css("cursor", "progress");
form.submit();
},
errorClass: 'input-error',
errorPlacement: function(error, element) {
var type = $(element).attr("type");

if(type === "checkbox" || type === "radio" || element.parent('.input-group').length) {
error.insertAfter(element.parent());
} else {
error.insertAfter(element);
}
}
});

