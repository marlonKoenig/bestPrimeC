<div class="logInBox">
    <div><img src="<?php echo $image_path . "images/login.png"; ?>" alt="" srcset=""></div>
    <div class="ui form">
        <h2>Login</h2>
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <button class="ui btn-lightBlue button fluid" onclick="logIn()">
            Einloggen
        </button>
        <br>
        <div class="textAlignCenter"><a href="../passwordReset">Passwort vergessen</a></div>
    </div>
    <div class="logoContainer">
        <img src="<?php echo $root; ?>media/webseite/icons/Logo-bestPrime.png" alt="" srcset="">
        <span>All Rights Reserved BestPrime GmbH​</span>
    </div>
</div>

<script>
    document.addEventListener("keydown", function(event) {
        let key = event.keyCode;
        if (key == 13) {
            logIn();
        }
    });

    function logIn() {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        $.get(
            root + "php/api.php", {
                "funktion": "logUserIn",
                "loginData": {
                    userId: email,
                    password: password
                }
            },
            function(res) {
                try {
                    console.log(res);
                    res = JSON.parse(res);
                    if (res.loginStatus == "success") {
                        location.replace(forwardPages[res.role]);
                        return;
                    }
                    throw "loginError";
                } catch (error) {
                    Swal.fire({
                        title: "Fehler",
                        icon: "error",
                        html: "Bitte überprüfe deine Eingaben",
                        showCloseButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Verstanden",
                    });

                }
            }

        );
    }
</script>