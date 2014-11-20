function call() {
    var msg = $('#passChangeForm').serialize();
    $.ajax({
        type: 'POST',
        url: '/ajax.php',
        data: msg,
        success: function(response) {
            $('#oldpass').css('border', ''); //the borders of inputs are set to default
            $('#newpass').css('border', '');
            $('#newpass2').css('border', '');
            
            if (response === 'limit') { // when the number of attempts exceeded the limit
                    $('#passChangeForm').hide();
                    $('#userBlocked').show();
                }

            if (response === 'success') {    // case of succcess
                $('#messanger').attr("class", "alert-box success radius");
                $('#messanger').html("SUCCESS! The password has been updated!");
            }
            
            else {   // case of errors
                $('#messanger').attr("class", "alert-box warning radius");
                
                if (response === 'mail') {
                    $('#messanger').html("Error occurred while setting a new password!</br>");
                }
                else {
                    var error_array = response.split('~');
                    var names = error_array[0].split(' ');
                    for (var i = 0; i < names.length; i++) {
                        if (names[i] == 'oldpass') {
                            $('#oldpass').css('border', 'red 1px solid');
                        }
                        if (names[i] == 'newpass') {
                            $('#newpass').css('border', 'red 1px solid');
                        }
                        if (names[i] == 'newpass2') {
                            $('#newpass2').css('border', 'red 1px solid');
                        }
                    }
                    var error = error_array[1];
                    $('#messanger').html(error);
                }
            }
            $('#messanger').show();
        }
    });
}