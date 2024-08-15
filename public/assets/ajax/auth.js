$('#formAuthentication').on('click', '.login', function(e){
    e.preventDefault();

    let form = $('#formAuthentication');
    let data = form.serialize();

    $.ajax({
        url: 'auth_process',
        data: data,
        method: 'POST',
        success:function(response)
        {
            $('.message').show();
            // Remove any existing alert classes
            $('.message').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
            // Show error message
            $('.message').addClass('alert alert-success bg-success text-white').text(response.message).show();
            $('html, body').animate({ scrollTop: 0 }, 'fast');
            setTimeout(function () {
                $('.message').fadeOut(function () {
                    $(this).empty().removeClass('alert alert-danger bg-danger text-white').hide();
                });

                if(response.role == 1)
                {
                    window.location.href='admin/';
                }
                else if(response.role == 2)
                {
                    window.location.href='guru/';
                }
                else if(response.role == 3)
                {
                    window.location.href='siswa/';
                }

            }, 3000);
        },
        error:function(xhr)
        {
            let errorMessage = xhr.responseText;
            let error = JSON.parse(errorMessage).message;
            let errorMessages = "";

            if(Array.isArray(error))
            {
                $.each(error, function(index, value){
                    errorMessages += ". " + value + "<br>";
                });
            }else{
                errorMessages += ". " + error + "<br>";
            }

            $('.message').addClass('alert alert-danger bg-danger text-white').html(errorMessages).show();
            $('.message').fadeIn().delay(3000).fadeOut(function() {
                $(this).removeClass('alert alert-danger bg-danger text-white').hide();
            });

        }
    });
});

let message = localStorage.getItem('logoutMessage');

if(message)
{
    $('.message').show();
    // Remove any existing alert classes
    $('.message').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
    // Show error message
    $('.message').addClass('alert alert-success bg-success text-white').text(message).show();
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    setTimeout(function () {
        $('.message').fadeOut(function () {
            $(this).empty().removeClass('alert alert-success bg-success text-white').hide();
        });
    }, 3000);

    localStorage.removeItem('logoutMessage');
}

var urlParams = new URLSearchParams(window.location.search);
var log = urlParams.get('message');

if(log)
{
    $('.message').show();
    // Remove any existing alert classes
    $('.message').removeClass('alert-success bg-success alert-danger bg-danger text-white').empty();
    // Show error message
    $('.message').addClass('alert alert-danger bg-danger text-white').text(log).show();
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    setTimeout(function () {
        $('.message').fadeOut(function () {
            $(this).empty().removeClass('alert alert-danger bg-danger text-white').hide();
        });
    }, 3000);
}
