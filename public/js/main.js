$(document).ready(function () {

    $(document).on('blur', '#email', function (e) {
        validateEmailInput()
    })

    $(document).on('click', '#saveBtn', function () {
        if (validateEmailInput() == false) {
            alert('Please check form again');
        }
        else {
            submitForm();
        }
    })
});

function ValidateEmail(email) {
    return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email));
}

function validateEmailInput() {

    var $email_ele = $('#email');
    var ret = false;

    var $span = $email_ele.siblings('span.error_msg');

    if (ValidateEmail($email_ele.val()) == true) {
        $msg = '';
        $span.removeClass('show');
        ret = true;
    }
    else {
        $msg = 'Invalid msg'
        $span.addClass('show');
    }

    $span.text($msg);
    return ret;
}

function submitForm() {

    $form = $('#collectForm');

    $.ajax({
        method: "POST",
        url: $form.attr('action'),
        data: { email:$('#email').val()}
    }).done(function (response) {
        
        alert(response.msg);

        if(response.status == true)
        {
            window.location.href = window.location.href;
        }
    });
}