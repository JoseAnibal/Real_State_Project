"use strict"

document.addEventListener("DOMContentLoaded", function() {

    imageselector();

    function imageselector(){
        const contenedor=document.querySelector(".imagesselector");
        const input=document.querySelector(".imagesarray");

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

                    for (const attr in imageattr) {
                        img.setAttribute(attr, imageattr[attr]);
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

                    divaux.appendChild(img);
                    div.appendChild(divaux);
                }
                
            });

        });

    }
});
