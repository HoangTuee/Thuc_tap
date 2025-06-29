document.addEventListener("DOMContentLoaded", function () {
    const passwordInputRegister = document.getElementById("passwordRegister");
    const togglePasswordRegister = document.getElementById("togglePasswordRegister");

    if (passwordInputRegister && togglePasswordRegister) {
        const eyeIconRegister = togglePasswordRegister.querySelector("i");

        togglePasswordRegister.addEventListener("click", function () {
            const type = passwordInputRegister.type === "password" ? "text" : "password";
            passwordInputRegister.type = type;
            eyeIconRegister.classList.toggle("fa-eye");
            eyeIconRegister.classList.toggle("fa-eye-slash");
        });
    }
});
