let mensaje = document.getElementById("mensaje");
let seleccion = document.getElementById("seleccion");
let formulario = document.getElementById("formulario");
let advertencia = document.getElementById("texto-rojo");

let frase1 = '“Smart Functional Training: Flexibilidad y excelencia en entrenamiento a distancia, adaptado a tu ritmo y estilo de vida.”'
let frase2 = '“En Smart Functional Training, cada paso es un salto hacia tu bienestar integral, guiado por excelencia y calidez humana.”'

function cambiar_mensaje(){
    if(mensaje.innerHTML == frase2){
        mensaje.style.opacity = 0;
        setTimeout(()=>{
            mensaje.innerHTML = frase1;
            mensaje.style.opacity = 1;
        }, 1000); 
    }
    else{
        mensaje.style.opacity = 0;
        setTimeout(()=>{
            mensaje.innerHTML = frase2;
            mensaje.style.opacity = 1;
        }, 1000);        
    }
    setTimeout(cambiar_mensaje, 10000);
}

formulario.addEventListener("submit", (e)=>{
    if (seleccion.value == "Seleccione el tipo de consulta"){
        e.preventDefault();
        advertencia.classList.remove("d-none")
    }
})

cambiar_mensaje();