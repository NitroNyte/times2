 $(document).ready(function () {
      $("#registerForm").validate({
        rules: {
            emri: "required",
            mbiemri: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            emri: "Please enter a name!",
            mbiemri: "Please enter a surname!",
            email: {
                required: "Please enter a email!",
                email: "Please enter a valid email!"
            },
            password: {
                required: "Please enter a password!",
                minlength: "The password must be at least 8 characters long"
            }
        },
        submitHandler: function (form) {
            const emri = $("#emri").val();
            const mbiemri = $("#mbiemri").val();
            const email = $("#email").val();
            const password = $("#password").val();

            $.post("register_user.php", {
                emri: emri,
                mbiemri: mbiemri,
                email: email,
                password: password
            }).done(function (response) {
              if(response == "emailTaken"){
                $("#registerMessage").text("You have created a new account").css("color", "green");
              }
              else{
                $("#registerMessage").text("You have created a new account").css("color", "red");
              }
                
            }).fail(function () {
                $("#registerMessage").text("An error occurred.").css("color", "red");
            });

        }
    });
});