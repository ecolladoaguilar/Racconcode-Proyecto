//Ajax info
function info() {
    var user = document.getElementById("user").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("registrado").innerHTML = "Su cuenta se ha registrado";
        }
    }
    xhr.open('POST', 'register.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send("user=" + user + "&email=" + email + "&password=" + password);
}

document.getElementById("registerForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const user = document.getElementById("user").value;
    const password = document.getElementById("password").value;
    const passwordConfirm = document.getElementById("passwordConfirm").value;
    const email = document.getElementById("email").value;

    // Verificar campos vacíos
    if (user.trim() === "" || password.trim() === "" || passwordConfirm.trim() === "" || email.trim() === "") {
        alert("Por favor, complete todos los campos.");
        return;
    }

    let emailValid = false;
    let passwordValid = false;

    //Verificar email 
    function verifyemail() {
        const patron = /\S+@\S+\.\S+/;

        if (patron.test(email)) {
            console.log("Email correcto");
            emailValid = true;
        } else {
            alert("Pruebe a poner otra vez el correo");
            emailValid = false;
        }
    }

    //Verificar contraseña
    function verify() {
        const req = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/;

        if (req.test(password)) {
            console.log("Contraseña correcta");
            passwordValid = true;
        } else {
            alert("La contraseña debe tener al menos 8 caracteres, incluyendo una letra minúscula, una mayúscula, un número y un carácter especial");
            passwordValid = false;
        }
    }

    if (password !== passwordConfirm) {
        alert("Las contraseñas no coinciden. Por favor, inténtalo de nuevo.");
        return;
    } else {
        verify();
        verifyemail();

        // Llamar a la función info() solo si el correo electrónico y la contraseña son válidos
        if (emailValid && passwordValid) {
            info();
            console.log("Usuario: ", user, "Contraseña: ", password, "Correo: ", email);
        }
    }
});