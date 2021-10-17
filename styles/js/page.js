/*var text = document.getElementById("dirijido")
text.addEventListener("input",(event)=>{
    event.target.setAttribute("size",event.target.value.length)
    console.log(event.target.value.length)
})*/

document.getElementById("fecha-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("fecha").innerHTML=input;
});

document.getElementById("profesion-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("profesion").innerHTML=input;
});

document.getElementById("nombre-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("nombre").innerHTML=input;
});

document.getElementById("rol-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("rol").innerHTML=input;
});

document.getElementById("cuerpo-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("cuerpo").innerText=input;
});
document.getElementById("document-name-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("document-name").innerHTML = input;
});

document.getElementById("cordial-form").addEventListener("keyup",(event)=>{
    var input = event.path[0].value;
    document.getElementById("cordial").innerText=input;
});