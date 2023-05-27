"use strict"

const propertiescontainer=document.querySelector('#propertiescontainer');
const cargando=document.querySelector(".cargando");
let urlweb=(window.location.href).split('/').slice(0,3).join('/');
const viewmore=document.querySelector('.viewmore');
let click=0;

filterData();
initData();

const filterbtn=document.querySelector('.filter');
filterbtn.addEventListener('click', ()=>{
    propertiescontainer.innerHTML='';
    click=0;
    initData();
});

async function initData(){
    const form=document.querySelector("#filters");
    form.preventDefault;
    const formData=new FormData(form);

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
                    <a href="${urlweb}/properties/${e.id}">
                        <img src="${urlweb}/${e.image}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                    </a>
                    <div class="card-body d-flex flex-column px-0">
                        <a href="${urlweb}/properties/${e.id}" class="text-black">
                            <h5 class="card-title text-start"><b>${e.title}</b></h5>
                        </a>
                        <p class="card-text text-start property-desc">${e.description}</p>
                    </div>
                    <div class="border-0 p-0 d-flex justify-content-end">
                        <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">${e.price} €</span>
                    </div>

                    <div class="dropdown position-absolute start-100">
                        <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <ul class="dropdown-menu col-6">
                            <li>
                                <form action="${urlweb}/properties/${e.id}/edit" method="get" class="dropdown-item px-0 col-8">
                                    <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                </form>
                            </li>
                            <li>
                                <button type="submit" id="deleteproperty_${e.id}" class="d-flex justify-content-center py-2 btn border-0 dropdown-item px-0 col-8"><i class="fa-solid fa-trash"></i>Eliminar</button>
                            </li>
                        </ul>
                    </div>
                </div>  
                `;
    
                propertiescontainer.appendChild(divchild);
    
                const deleteproperty=document.getElementById(`deleteproperty_${e.id}`);
                deleteproperty.addEventListener('click', async (de)=>{
    
                    const respuesta=await fetch(`${urlweb}/api/delete_property/${e.id}`,{
                        method: 'POST'
                    });
                    const datos=await respuesta.json();
    
                    if(respuesta.ok){
                        divchild.classList.add('fade-out');
                        divchild.style.display='none';
                        setTimeout(function() {
                            divchild.remove();
                        }, 300);
                        showAlert(datos.message,'warning');
                    }
    
                });
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
    const form=document.querySelector("#filters");
    form.preventDefault;
    
    const viewmore=document.querySelector(".viewmore");
    viewmore.preventDefault;

    viewmore.addEventListener('click',async (el)=>{
        click++;
        cargando.classList.remove('hide');
        const formData=new FormData(form);
        formData.append('offset', click);
    
        const respuesta=await fetch(`${urlweb}/api/get_properties`,{
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
                                    <a href="${urlweb}/properties/${e.id}">
                                        <img src="${urlweb}/${e.image}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                                    </a>
                                    <div class="card-body d-flex flex-column px-0">
                                        <a href="${urlweb}/properties/${e.id}" class="text-black">
                                            <h5 class="card-title text-start"><b>${e.title}</b></h5>
                                        </a>
                                        <p class="card-text text-start property-desc">${e.description}</p>
                                    </div>
                                    <div class="border-0 p-0 d-flex justify-content-end">
                                        <span href="#" class="col-4 text-centerbadge rounded-pill text-bg-primary px-6 py-2">${e.price} €</span>
                                    </div>

                                    <div class="dropdown position-absolute start-100">
                                        <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </button>
                                        <ul class="dropdown-menu col-6">
                                            <li>
                                                <form action="${urlweb}/properties/${e.id}/edit" method="get" class="dropdown-item px-0 col-8">
                                                    <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                                </form>
                                            </li>
                                            <li>
                                                <button type="submit" id="deleteproperty_${e.id}" class="d-flex justify-content-center py-2 btn border-0 dropdown-item px-0 col-8"><i class="fa-solid fa-trash"></i>Eliminar</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                `;

                propertiescontainer.appendChild(divchild);

                const deleteproperty=document.getElementById(`deleteproperty_${e.id}`);
                deleteproperty.addEventListener('click', async (de)=>{
                    
                    const respuesta=await fetch(`${urlweb}/api/delete_property/${e.id}`,{
                        method: 'POST'
                    });
                    const datos=await respuesta.json();

                    if(respuesta.ok){
                        divchild.classList.add('fade-out');
                        divchild.style.display='none';
                        setTimeout(function() {
                            divchild.remove();
                        }, 300);
                        showAlert(datos.message,'warning');
                    }

                });
        });
            cargando.classList.add('hide');
        }
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
        alert.classList.add('hide','fade-out');
        setTimeout(function() {
        alert.remove();
        }, 500);
    }, 2000);

    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
        });
}