$(
    function() {
        $('#select_1').change(function() {
          if (this.value != 'none') {
              $('#select_2').empty();
              load_data_signin(this.value);
              $('#select_2').removeAttr('disabled');
          } else {
              $('#select_2').attr('disabled', 'true');
          }
        });

        $('#select_province').change(function() {
           if (this.value != 'none') {
               $('#select_city').empty();
               load_data_city(this.value);
               $('#select_city').removeAttr('disabled');
           } else {
               $('#select_city').attr('disabled', 'true');
           }
        });
        
        $('#select_city').change(function() {
            if (this.value != 'none') {
                $('#select_district').empty();
                load_data_district(this.value);
                $('#select_district').removeAttr('disabled');
            } else {
                $('#select_district').attr('disabled', 'true');
            }
        });
        
        $('#show_search').click(function() {
            if ($('#form_search').is(':hidden')) {
                $('#form_search').show(500);
                $(this).val('Hide Search');
            } else {
                $('#form_search').hide(500);
                $(this).val('Show Search');
            }
        });
});

function load_data_district(value) {
   var url = window.location.protocol + '//' + window.location.host + window.location.pathname + '?r=user/DataDistrict';
   $.ajax({
       type: 'POST',
       url: url,
       data: {
           value: value
       },
       success: function(msg){
           $.each($.parseJSON(msg), function(key, value){ 
               add_option('select_district', key, value);
           })
       }
   });
}

function load_data_city(value) {
   var url = window.location.protocol + '//' + window.location.host + window.location.pathname + '?r=user/DataCity';
   $.ajax({
       type: 'POST',
       url: url,
       data: {
           value: value
       },
       success: function(msg){
           $.each($.parseJSON(msg), function(key, value){ 
               add_option('select_city', key, value);
           })
       }
   });
}

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