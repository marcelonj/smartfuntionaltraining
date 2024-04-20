let mensaje = document.getElementById("mensaje");
let seleccion = document.getElementById("seleccion");
let formulario = document.getElementById("formulario");
let boton_entrenamiento_si = document.getElementById("entrenamiento_si");
let boton_entrenamiento_no = document.getElementById("entrenamiento_no");
let boton_asesorias_si = document.getElementById("asesorias_si");
let boton_asesorias_no = document.getElementById("asesorias_no");
let boton_coaching_si = document.getElementById("coaching_si");
let boton_coaching_no = document.getElementById("coaching_no");
let opciones_entrenamiento = document.getElementById("opciones_entrenamiento");
let opciones_asesorias = document.getElementById("opciones_asesorias");
let opciones_coaching = document.getElementById("opciones_coaching");

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

function mostrar_ocultar_opciones(elemento){
    if (elemento.classList.contains('d-none')){
        elemento.classList.remove('d-none');
    }
    else{
        elemento.classList.add('d-none');
    }
}

boton_entrenamiento_si.addEventListener("change", ()=>{
    if (boton_entrenamiento_si.checked){
        opciones_entrenamiento.classList.remove('d-none');
    }
})

boton_asesorias_si.addEventListener("change", ()=>{
    if (boton_asesorias_si.checked){
        opciones_asesorias.classList.remove('d-none');
    }
})

boton_coaching_si.addEventListener("change", ()=>{
    if (boton_coaching_si.checked){
        opciones_coaching.classList.remove('d-none');
    }
})

boton_entrenamiento_no.addEventListener("change", ()=>{
    if (boton_entrenamiento_no.checked){
        opciones_entrenamiento.classList.add('d-none');
        document.getElementById('masa_muscular').checked = false
        document.getElementById('perder_grasa').checked = false
    }
})

boton_asesorias_no.addEventListener("change", ()=>{
    if (boton_asesorias_no.checked){
        opciones_asesorias.classList.add('d-none');
        document.getElementById('asesorias_1').checked = false
        document.getElementById('asesorias_2').checked = false
        document.getElementById('asesorias_4').checked = false
    }
})

boton_coaching_no.addEventListener("change", ()=>{
    if (boton_coaching_no.checked){
        opciones_coaching.classList.add('d-none');
        document.getElementById('coaching_ontologico').checked = false
        document.getElementById('coaching_deportivo').checked = false
    }
})

cambiar_mensaje();