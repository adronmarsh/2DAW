function copiarTexto() {
    const texto = document.querySelector('#miCorreo').innerText;
    navigator.clipboard.writeText(texto);
    document.querySelector('#copiado').style.display = 'block';
    setTimeout(function () {
        document.querySelector('#copiado').style.display = 'none';
    }, 1000);
}