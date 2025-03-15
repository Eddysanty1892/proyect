document.getElementById("switch-to-register").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("login-form").classList.add("hidden");
    document.getElementById("register-form").classList.remove("hidden");
    document.getElementById("form-title").innerText = "Registro";
    document.getElementById("register-form").style.animation = "slideIn 0.5s ease-in-out";
});

document.getElementById("switch-to-login").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("register-form").classList.add("hidden");
    document.getElementById("login-form").classList.remove("hidden");
    document.getElementById("form-title").innerText = "Iniciar Sesión";
    document.getElementById("login-form").style.animation = "slideIn 0.5s ease-in-out";
});
