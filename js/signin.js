$(function() {
   $('#select_1').change(function() {
     if (this.value != 'none') {
         $('#select_2').empty().append('<option selected="selected" value="none">Select</option>');
         load_data_signin(this.value);
         $('#select_2').removeAttr('disabled');
     } else {
         $('#select_2').attr('disabled', 'true');
     }
   });
});

function load_data_signin(value) {
       var url = window.location.protocol + '//' + window.location.host + window.location.pathname + '?r=user/DataSignin';
   $.ajax({
       type: 'POST',
       url: url,
       data: {
           value: value
       },
       success: function(msg){
           $.each($.parseJSON(msg), function(key, value){ 
               add_option('select_2', key, value);
           })
       }
   });
}

function add_option(text, key, value){
    $('#'+text).append($("<option/>", {
        value: key,
        text: value
    }));
}