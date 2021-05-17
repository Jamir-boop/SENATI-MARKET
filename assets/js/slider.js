const boton_izq = document.querySelector(".boton_izquierda");
const boton_der = document.querySelector(".boton_derecha");
const carrusel = document.querySelector(".contenedor_diapositivas");


let posicion = 0;
let interruptor = "adelante";


const ejecutar = (cont) => {
    if(cont >= 0){
        carrusel.style.marginLeft = `-${cont * 100}%`;
    }
}

const atras = (e) => {
    posicion = posicion - 1;
    ejecutar(posicion);
};


const adelante = (e) => {
    posicion = posicion + 1;
    ejecutar(posicion);
}


const muevete = () => {
    if(posicion === (carrusel.children.length - 1)){
        interruptor = "atras";
    }else if(posicion === 0){
        interruptor = "adelante";
    }

    if(interruptor === "atras" ){
        atras();
    }

    if(interruptor === "adelante" ){
        adelante();
    }
}


boton_izq.addEventListener("click", atras);
boton_der.addEventListener("click", adelante);


setInterval(muevete, 5000);