window.onload = () => {
    const token = obtenerToken();
    if( token ){
        mostrarMenu();
    }
};

let obtenerToken = () => {
    const cookies = obtenerCookies( 'token' );
    return cookies['token'];
};

let obtenerCookies = (...nombres) => {
    const cookiesStr = document.cookie;
    const cookiesArr = cookiesStr.split(";");
    let mapaValores = {};
    for( let cookieVal of cookiesArr ){
        let cookieValArr = cookieVal.split("=");
        if( nombres.includes(cookieValArr[0]) ){
            mapaValores[cookieValArr[0]] = cookieValArr[1];
        }
    }
    return mapaValores;
};

let mostrarMenu = () => {
    let navEl = document.querySelector('nav.nav');
    if( navEl ){
        navEl.classList.remove('invisible');
    }
};