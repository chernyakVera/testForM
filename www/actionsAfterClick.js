
function submitRegistrationForm() {
    var loginValue = $('input.login').val();
    var passwordValue = $('input.password').val();
    var confirmPasswordValue = $('input.confirmPassword').val();
    var emailValue = $('input.email').val();
    var nameValue = $('input.name').val();

    $.ajax({
        method: "POST",
        url: "/",
        data: {
            login: loginValue,
            password: passwordValue,
            confirmPassword: confirmPasswordValue,
            email: emailValue,
            name: nameValue,
        }
    })
        .done(function(msg) {
            // debugger;
            let message = JSON.parse(msg);
            if (message.status === 'error') {
                if (message.type === 'login') {
                    $("#loginError").show();
                    $("#loginError").text(message.message);
                    setTimeout(function () {
                        $("#loginError").hide();
                    }, 5000);
                } else if (message.type === 'password') {
                    $("#passwordError").show();
                    $("#passwordError").text(message.message);
                    setTimeout(function () {
                        $("#passwordError").hide();
                    }, 5000);
                } else if (message.type === 'confirmPassword') {
                    $("#confirmPasswordError").show();
                    $("#confirmPasswordError").text(message.message);
                    setTimeout(function () {
                        $("#confirmPasswordError").hide();
                    }, 5000);
                } else if (message.type === 'email') {
                    $("#emailError").show();
                    $("#emailError").text(message.message);
                    setTimeout(function () {
                        $("#emailError").hide();
                    }, 5000);
                } else if (message.type === 'name') {
                    $("#nameError").show();
                    $("#nameError").text(message.message);
                    setTimeout( function () {
                        $("#nameError").hide();
                    }, 5000);
                }
            } else {
                window.location.href = message.message;
            }

        });

    $('input.login').val('');
    $('input.password').val('');
    $('input.confirmPassword').val('');
    $('input.email').val('');
    $('input.name').val('');
};



function submitLogInForm() {
    var loginValue = $('input.login').val();
    var passwordValue = $('input.password').val();

    $.ajax({
        method: "POST",
        url: "/users/login",
        data: {
            login: loginValue,
            password: passwordValue,
        }
    })
        .done(function( msg) {
            // debugger;
            let message = JSON.parse(msg);
            if (message.status === 'error') {
                if (message.type === 'login') {
                    $("#loginError").show();
                    $("#loginError").text(message.message);
                    setTimeout(function () {
                        $("#loginError").hide();
                    }, 5000);
                } else if (message.type === 'password') {
                    $("#passwordError").show();
                    $("#passwordError").text(message.message);
                    setTimeout(function () {
                        $("#passwordError").hide();
                    }, 5000);
                }
            } else {
                window.location.href = message.message;
            }
        })
        $('input.login').val('');
        $('input.password').val('');
    };


