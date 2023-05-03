"use strict"

document.addEventListener("DOMContentLoaded", function() {

    imageselector();

    async function imageselector(){
        const input=document.querySelector(".imagesarray");
        const contenedor=document.querySelector(".imagesselector");
        const arrayImagenes=[];
        const url=window.location.href;
        const idproperty=url.split("/")[4];

        const buttonattr={
            class:"btn btn-primary rounded-circle deleteimage d-flex align-items-center justify-content-center",
            type:"button",
            style:"position: absolute; top:0; right:0; height:2rem; width:2rem; opacity: 0.8; color: black;background-color: white; border-color: white;"
        };

        const imageattr={
            class:"object-fit-cover w-100 rounded-4",
        };

        const divauxattr={
            class:"d-flex object-fit-cover",
            style: "height: 6rem; width: 6rem; position: relative;"
        };


        input.addEventListener("change",()=>{
            contenedor.innerHTML='';
            const div=document.createElement("div");
            div.classList.add("d-flex","flex-wrap","justify-content-around","align-items-center");

            contenedor.appendChild(div);

            Array.from(input.files).forEach((e,i)=>{
                if(e.type.split("/")[0]=="image"){
                    const divaux=document.createElement("divaux");
                    const img=document.createElement("img");
                    const elim = document.createElement("button");
                    elim.innerHTML="<i class='fa-regular fa-circle-xmark'></i>";

                    for (const attr in imageattr) {
                        img.setAttribute(attr, imageattr[attr]);
                    }

                    for (const attr in buttonattr) {
                        elim.setAttribute(attr, buttonattr[attr]);
                    }

                    for (const attr in divauxattr) {
                        divaux.setAttribute(attr, divauxattr[attr]);
                    }

                    img.setAttribute(
                        'src',
                        URL.createObjectURL(e),
                    );

                    divaux.setAttribute(
                        'id',
                        i,
                    );

                    elim.setAttribute(
                        'id',
                        i,
                    );

                    elim.addEventListener('click',(el)=>{
                        elim.parentElement.remove();
                        arrayImagenes.splice(arrayImagenes.indexOf(input.files[i]),1);
                        console.log(arrayImagenes);
                    });

                    arrayImagenes.push(input.files[i]);

                    divaux.appendChild(img);
                    divaux.appendChild(elim);
                    div.appendChild(divaux);
                }
                
            });

        });



        document.querySelector(".sendButton").addEventListener("click",async ()=>{
            const formulario=document.querySelector("#formApi");
            const formData = new FormData(formulario);

            const cargando=document.querySelector(".cargando");
            cargando.classList.remove('hide');

            formData.delete('image[]');
            
            arrayImagenes.forEach((e,i)=>{
                formData.append('image[]', e);
            });

            const valorSelect=formData.get('type');

            if(valorSelect==2 || valorSelect==3){
                formData.delete('rooms');
                formData.delete('baths');
            }

            const data=new URLSearchParams(formData);
            console.log(data);

            const respuesta=await fetch('http://127.0.0.1:8000/api/update_property/'+idproperty,{
                method: 'PATCH',
                body: data
            });
            const datos=await respuesta.json();

            if(respuesta.ok){
                cargando.classList.add('hide');
            }else{
                for(const llave in datos.errors){
                    showAlert(datos.errors[llave][0],"danger");
                    // console.log(datos.errors[llave][0]);
                }
            }

            cargando.classList.add('hide');
            

        });


    }

    function showAlert(message, type) {
        // Crear un nuevo elemento de alerta
        const alert = document.createElement('div');
        alert.classList.add('alert', `alert-${type}`, 'fade', 'show');
        
        // Agregar el mensaje a la alerta
        alert.innerText = message;
        
        // Agregar la alerta al documento
        const container = document.querySelector('.container');
        container.insertBefore(alert, container.firstChild);
        
        // hide la alerta después de 3 segundos
        setTimeout(function() {
            alert.classList.remove('show');
            alert.classList.add('hide');
            setTimeout(function() {
            alert.remove();
            }, 500);
        }, 3000);
    
        window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth'
          });
        }
    
});