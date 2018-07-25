$(document).ready(function() {

    $('#wZIP').keydown(function(e) {
        
        if(e.keyCode === 13)
        {
            $('#weatherZIP').formValidation();
            //$('#weatherZIP').submit();
        }
        
    }); 

    /*
    $('#wCity').on('change', function() {
        
        $('#weatherCity').submit();
        
    });
    */

});