<div class="logInBox">
    <div><img src="<?php echo $image_path . "images/login.png"; ?>" alt="" srcset=""></div>
    <div class="ui form">
        <h2>Passwort zurücksetzen</h2>
        <div class="field">
            <label>Email</label>
            <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <button class="ui btn-lightBlue button fluid" onclick="requestPasswordReset()">
            Zurücksetzen
        </button>
    </div>
    <div class="logoContainer">
        <img src="<?php echo $root; ?>media/webseite/icons/Logo-bestPrime.png" alt="" srcset="">
        <span>All Rights Reserved BestPrime GmbH​</span>
    </div>
</div>

<script>
    function requestPasswordReset() {
        let email = document.getElementById("email").value;

        $.get(
            root + "php/api.php", {
                "funktion": "requestPasswordReset",
                "userData": {
                    userId: email,
                }
            },
            function(res) {
                try {
                    console.log(res);
                    res = JSON.parse(res);
                    console.log(res);
                    if (res.userNotified == "true") {
                        Swal.fire({
                            title: "Erfolgreich",
                            icon: "success",
                            html: "Sie haben nun eine E-Mail erhalten, mit welcher Sie Ihr Passwort zurücksetzen können.",
                            showCloseButton: true,
                            showCancelButton: false,
                            confirmButtonText: "Verstanden",
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