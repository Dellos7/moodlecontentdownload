
let mostrarOcultarContenidosCarpeta = (id) => {
    let contenidosCarpetaEl = document.querySelector('#contenidos-carpeta-' + id);
    if( contenidosCarpetaEl ){
        contenidosCarpetaEl.classList.toggle('invisible');
    }
};

