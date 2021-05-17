const contenedor_campos = document.querySelectorAll('.campo');




const mover_label = (e) => {
    verificar_focos_hijos();
    
    if(e.target.tagName !== 'INPUT'){
        if(e.target.tagName !== 'LABEL'){
            verificar_focos_hijos();
        }
    }else{
        
        let elementos_padre = e.target.parentNode.children;
        e.target.parentNode.classList.add('colorear_borde');
        elementos_padre[0].classList.add('mover_arriba');
        elementos_padre[0].classList.add('colorear_txt');
    }
};





const verificar_focos_hijos = (e) => {
    for(let i = 0; i < contenedor_campos.length; i++){
        if(contenedor_campos[i].children[1].value !== ''){
            continue;
        }

        contenedor_campos[i].classList.remove('colorear_borde');
        contenedor_campos[i].children[0].classList.remove('mover_arriba');
        contenedor_campos[i].children[0].classList.remove('colorear_txt');        
    }
}


const desmarcar = (e) => {
    if(e.target.tagName !== 'INPUT'){
        verificar_focos_hijos();
        console.log('si');
    }
}


const click_input = (e) => {
    e.stopPropagation();

    if(e.target.tagName === 'LABEL'){
        let elementos_padre = e.target.parentNode.children;

        elementos_padre[0].classList.add('mover_arriba');
        elementos_padre[1].focus();
    }
}


for(let i = 0; i < contenedor_campos.length; i++){
    contenedor_campos[i].children[1].addEventListener('focus', mover_label);
    contenedor_campos[i].children[0].addEventListener('click', click_input);
}



document.body.addEventListener('click', desmarcar);