function emailConfirmar() {
    var email = document.getElementById("email").value;
    var verificar = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.trim() === "") {
        window.alert("Por favor, digite um e-mail.");
    } else if (verificar.test(email)) {
        window.alert("Seu e-mail foi computado, aguarde nossa resposta.");
    } else {
        window.alert("Digite um e-mail válido.");
    }
}
