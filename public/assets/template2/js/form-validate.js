document.addEventListener('DOMContentLoaded', function () {
    var emailInput = document.getElementById("email");
    var psw = document.getElementById("password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    var submit = document.getElementById("twoBtn");

    emailInput.addEventListener("input", function () {
        var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailInput.value.match(emailFormat)) {
            psw.disabled = false;
        } else {
            psw.disabled = true;
        }
    });

    // When the user starts to type something inside the password field
    psw.onkeyup = function () {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if (psw.value.match(lowerCaseLetters)) {
            letter.classList = "fa fa-circle text-success";
        } else {
            letter.classList = "fa fa-circle text-danger";
        }

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if (psw.value.match(upperCaseLetters)) {
            capital.classList = "fa fa-circle text-success";
        } else {
            capital.classList = "fa fa-circle text-danger";
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if (psw.value.match(numbers)) {
            number.classList = "fa fa-circle text-success";
        } else {
            number.classList = "fa fa-circle text-danger";
        }

        // Validate length
        if (psw.value.length >= 8) {
            length.classList = "fa fa-circle text-success";
        } else {
            length.classList = "fa fa-circle text-danger";
        }

        if (
            letter.classList.contains("text-success") &&
            capital.classList.contains("text-success") &&
            number.classList.contains("text-success") &&
            length.classList.contains("text-success")
        ) {
            submit.style.display = "block";
        } else {
            submit.style.display = "none";
        }

    }
})