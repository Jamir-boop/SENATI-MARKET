const luna = document.querySelector(".noche");
const logo = document.getElementById("logotpf");



const cambiar_logo = () => {
    if(localStorage.getItem('dark-mode') === "true"){
        logo.setAttribute('src', 'assets/img/logo3.png');

    }else if(localStorage.getItem('dark-mode') === "false"){
        logo.setAttribute('src', 'assets/img/logo2.png');
    }
}


const ejecutar_nocturno = () => {
    if(document.body.className == ""){
        cambiar_logo();
        document.body.classList.add("dark");
        localStorage.setItem('dark-mode', true);
    }else{
        cambiar_logo();
        document.body.classList.remove("dark");
        localStorage.setItem('dark-mode', false);
    }

}



luna.addEventListener("click", ejecutar_nocturno);


if(localStorage.getItem('dark-mode')){
    document.body.classList.add("dark")
}