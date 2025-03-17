document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");

    if (passwordInput && eyeIcon) { // Kiểm tra nếu tồn tại
        eyeIcon.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        });
    }
});

const passwordInputRegister = document.getElementById("passwordRegister");
const togglePasswordRegister = document.getElementById("togglePasswordRegister");
const eyeIconRegister = togglePasswordRegister.querySelector("i");

togglePasswordRegister.addEventListener("click", function () {
    if (passwordInputRegister.type === "password") {
        passwordInputRegister.type = "text";
        eyeIconRegister.classList.remove("fa-eye");
        eyeIconRegister.classList.add("fa-eye-slash");
    } else {
        passwordInputRegister.type = "password";
        eyeIconRegister.classList.remove("fa-eye-slash");
        eyeIconRegister.classList.add("fa-eye");
    }
});
