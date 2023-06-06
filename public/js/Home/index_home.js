"use strict"

const propertiescontainer=document.querySelector('#propertiescontainer');
const cargando=document.querySelector(".cargando");
let urlweb=(window.location.href).split('/').slice(0,3).join('/');
const viewmore=document.querySelector('.viewmore');
let click=0;

filterData();
initData();

async function initData(){
    const formData=new FormData();

    cargando.classList.remove('hide');
    const respuesta=await fetch(`${urlweb}/api/get_properties`,{
        method: 'POST',
        body: formData
    });
    const datos=await respuesta.json();

    if(respuesta.ok){
        
        if(datos.properties.length){
            datos.properties.forEach((e,i) => {
                const divchild=document.createElement('div');
                divchild.classList.add('rounded-4', 'property_card', 'my-3', 'mx-auto', 'mx-md-0', 'px-0', 'col-6', 'd-flex', 'justify-content-center','divChild');

                divchild.innerHTML=`
                <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">
                    <a href="${urlweb}/propertyshow/${e.id}">
                        <img src="${urlweb}/${e.image}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                    </a>
                    <div class="card-body d-flex flex-column px-0">
                        <a href="${urlweb}/propertyshow/${e.id}" class="text-black">
                            <h5 class="card-title text-start"><b>${e.title}</b></h5>
                        </a>
                        <p class="card-text text-start property-desc">${e.description}</p>
                    </div>
                    <div class="border-0 p-0 d-flex justify-content-end">
                        <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">${e.price} €</span>
                    </div>
                </div>  
                `;
    
                propertiescontainer.appendChild(divchild);
            });
            viewmore.classList.remove('hide');
        }else{
            propertiescontainer.innerHTML=`
            <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100 w-100'>
            
                <div class="p-3">
                    <img src="${urlweb}/Images/assets/empty.png" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                </div>
                <div>
                    <h5>No se han encontrado propiedades con esos filtros.</h5>
                </div>
            
            </div>`;
            viewmore.classList.add('hide');
        }
        cargando.classList.add('hide');
    }
}

function filterData(){
    const viewmore=document.querySelector(".viewmore");
    viewmore.preventDefault;

    viewmore.addEventListener('click',async (el)=>{
        click++;
        console.log(click);
        cargando.classList.remove('hide');
        const formData=new FormData();
        formData.append('offset', click);
    
        const respuesta=await fetch(`${urlweb}/api/index_properties`,{
            method: 'POST',
            body: formData
        });
        const datos=await respuesta.json();

        if(respuesta.ok){
            datos.properties.forEach((e,i) => {
                const divchild=document.createElement('div');
                divchild.classList.add('rounded-4', 'property_card', 'my-3', 'mx-auto', 'mx-md-0', 'px-0', 'col-6', 'd-flex', 'justify-content-center','divChild');

                divchild.innerHTML=`
                                <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">
                                    <a href="${urlweb}/propertyshow/${e.id}">
                                        <img src="${urlweb}/${e.image}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                                    </a>
                                    <div class="card-body d-flex flex-column px-0">
                                        <a href="${urlweb}/propertyshow/${e.id}" class="text-black">
                                            <h5 class="card-title text-start"><b>${e.title}</b></h5>
                                        </a>
                                        <p class="card-text text-start property-desc">${e.description}</p>
                                    </div>
                                    <div class="border-0 p-0 d-flex justify-content-end">
                                        <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">${e.price} €</span>
                                    </div>
                                </div>`;

                propertiescontainer.appendChild(divchild);
            });
            cargando.classList.add('hide');
        }
    });
}