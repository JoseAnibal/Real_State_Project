"use strict"

document.addEventListener("DOMContentLoaded", function() {

    showHideFields();
    imageselector();

    function showHideFields(){
        const typeselector=document.querySelector(".selectortype");
        const roomsfield=document.querySelector(".roomsfield");
        const bathsfield=document.querySelector(".bathsfield");


        typeselector.addEventListener("change",function(){
            const tvalue=typeselector.value;
        
            if(tvalue==2 || tvalue==3){
                roomsfield.style.display='none';
                bathsfield.style.display='none';
            }else{
                roomsfield.style.display='block';
                bathsfield.style.display='block';
            }
        });
    }

    function imageselector(){
        const input=document.querySelector(".imagesarray");
        const contenedor=document.querySelector(".imagesselector");


        input.addEventListener("change",function(){
            contenedor.innerHTML='';
            const div=document.createElement("div");
            contenedor.appendChild(div);

            const buttonattr={
                class:"btn btn-primary rounded-circle deleteimage",
                type:"button",
                style:"position: absolute; top:0; right:0"
            };
            const imageattr={
                class:"object-fit-cover w-100",
            };

            const divauxattr={
                class:"d-flex object-fit-cover",
            };
            
            console.log(Array.from(input.files));

            Array.from(input.files).forEach((e,i)=>{
                const divaux=document.createElement("divaux");
                const elim = document.createElement("button");
                // const text = document.createTextNode("<i class='fa-regular fa-circle-xmark'></i>");
                // elim.appendChild(text);
                elim.innerHTML="<i class='fa-regular fa-circle-xmark'></i>";

                for (const attr in buttonattr) {
                    elim.setAttribute(attr, buttonattr[attr]);
                }

                for (const attr in divauxattr) {
                    divaux.setAttribute(attr, divauxattr[attr]);
                }

                elim.addEventListener('click',(el)=>{
                    console.log(el.target.parentElement.remove());
                    // input.splice(i,1);
                    console.log(input.files);
                });

                divaux.setAttribute(
                    'style',
                    'position:relative',
                );

                divaux.setAttribute(
                    'id',
                    i,
                );

                elim.setAttribute(
                    'id',
                    i,
                );

                const img=document.createElement("img");
                img.setAttribute(
                    'src',
                    URL.createObjectURL(e),
                );
                for (const attr in imageattr) {
                    img.setAttribute(attr, imageattr[attr]);
                }

                divaux.appendChild(img);
                divaux.appendChild(elim);

                div.appendChild(divaux);

                console.log(e.name);
                console.log(img);
            });

        });

    }

});
