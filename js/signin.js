$(function() {
    $('#select_1').change(function() {
        if (this.value != 'none') {
            $('#select_2').empty().append('<option selected="selected" value="none">Select</option>');
            load_data_signin(this.value);
            $('#select_2').removeAttr('disabled');
        }
    });
});

function load_data_signin(value) {
    var url = 'index.php?r=user/loadData';
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            value: value
        },
        success: function(msg) {
      
            $.each($.parseJSON(msg), function(key, value){
              alert(key); 
            });
           
        }
    });
}

function add_option(text, key, value){
    $('#'+text).append($("<option/>", {
        value: key,
        text: value
    }));
}