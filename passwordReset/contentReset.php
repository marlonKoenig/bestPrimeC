<div class="logInBox">
    <div><img src="<?php echo $image_path . "images/login.png"; ?>" alt="" srcset=""></div>
    <div class="ui form">
        <h2>Passwort ändern</h2>
        <div class="field">
            <label>Neues Passwort</label>
            <input type="password" name="password" id="password" placeholder="Passwort">
        </div>
        <div class="field">
            <label>Neues Passwort wiederholen</label>
            <input type="password" name="passwordRepeat" id="passwordRepeat" placeholder="Passwort wiederholen">
        </div>
        <button class="ui btn-lightBlue button fluid" onclick="resetPassword()">
            Zurücksetzen
        </button>
    </div>
    <div class="logoContainer">
        <img src="<?php echo $root; ?>media/webseite/icons/Logo-bestPrime.png" alt="" srcset="">
        <span>All Rights Reserved BestPrime GmbH​</span>
    </div>
</div>

<script>
    function resetPassword() {
        let password = document.getElementById("password").value;
        let passwordRepeat = document.getElementById("passwordRepeat").value;

        if (password != passwordRepeat) {
            Swal.fire({
                title: "Fehler",
                icon: "error",
                html: "Die beiden Passwörter stimmen nicht überein",
                showCloseButton: true,
                showCancelButton: false,
                confirmButtonText: "Verstanden",
            });
            return;
        } else if (!checkPassword(password)) {
            Swal.fire({
                title: "Fehler",
                icon: "error",
                html: "Bitte wähle ein Passwort, welches aus Groß- und Kleinbuchstaben, sowie Sonderzeichen besteht (Min. 8 Zeichen)",
                showCloseButton: true,
                showCancelButton: false,
                confirmButtonText: "Verstanden",
            });
            return;
        }
        $.get(
            root + "php/api.php", {
                "funktion": "resetPassword",
                "userData": {
                    userId: '<?php echo $_GET["userId"] ?>',
                    password: password
                }
            },
            function(res) {
                try {
                    console.log(res);
                    res = JSON.parse(res);
                    console.log(res);
                    if (res.passwordResetted == "true") {
                        Swal.fire({
                            title: "Erfolgreich",
                            icon: "success",
                            html: "Das Passwort wurde erfolgreich zurückgesetzt.",
                            showCloseButton: true,
                            showCancelButton: false,
                            confirmButtonText: "Verstanden",
                        }).then(res => {
                            location.replace(loginPage);
                        });
                        return;
                    }
                    throw "requestError";
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