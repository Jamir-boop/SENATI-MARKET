const categorias_extra = document.querySelector(".mas_categorias");
const boton_extra = document.querySelector(".mas");


const mostrar_extra = (e) => {
    e.preventDefault();


    if(categorias_extra.className === "mas_categorias ocultar_extra"){
        categorias_extra.classList.remove("ocultar_extra");
        document.body.style.overflow = "hidden";

    }else if(categorias_extra.className === "mas_categorias"){
        categorias_extra.classList.add("ocultar_extra");
        document.body.style.overflow = "visible";
    
    }

}


boton_extra.addEventListener("click", mostrar_extra);