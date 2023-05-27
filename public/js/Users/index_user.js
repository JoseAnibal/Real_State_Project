"use strict"
const userscontainer=document.querySelector('#userscontainer');
const cargando=document.querySelector(".cargando");
const viewmore=document.querySelector('.viewmore');
let urlweb=(window.location.href).split('/').slice(0,3).join('/');
let click=0;

filterData();
initData();

const filterbtn=document.querySelector('.filter');
filterbtn.addEventListener('click', ()=>{
    userscontainer.innerHTML='';
    click=0;
    initData();
});

async function initData(){
    const form=document.querySelector("#filters");
    form.preventDefault;
    const formData=new FormData(form);

    cargando.classList.remove('hide');
    const respuesta=await fetch(`${urlweb}/api/get_users`,{
        method: 'POST',
        body: formData
    });
    const datos=await respuesta.json();

    if(respuesta.ok){
        
        if(datos.users.length){
            datos.users.forEach((e,i) => {
                const divchild=document.createElement('div');
                divchild.classList.add('col-12', 'col-xl-5', 'user-container', 'd-flex', 'rounded-4', 'position-relative', 'align-items-center', 'bg-graylight','divChild');
    
                divchild.innerHTML=`
                        <div class="d-flex h-100">    
                            <img src="${urlweb}/${e.image}" alt="1flat" class='rounded user_image object-fit-contain rounded-4 bg-graylight' style="width:6rem;">
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between text-start">
                            <h5 class="m-0 text-wrap text-break"><b>Nombre:</b> ${e.name}</h5>
                            <p class="m-0 py-2 text-wrap text-break"><b>Email:</b> ${e.email}</p>
                            <p class="m-0 text-wrap text-break"><b>Teléfono:</b> ${e.phone}</p>
                        </div>
                        <div class="dropdown position-absolute start-100 top-0">
                            <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu col-6">
                                <li>
                                    <form action="${urlweb}/users/${e.id}/edit" method="get" class="dropdown-item px-0 col-8">
                                        <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                    </form>
                                </li>
                                <li>
                                    <button type="submit" id="deleteuser_${e.id}" class="d-flex justify-content-center py-2 btn border-0 dropdown-item px-0 col-8"><i class="fa-solid fa-trash"></i>Eliminar</button>
                                </li>
                            </ul>
                        </div>`;
    
                userscontainer.appendChild(divchild);
    
                const deleteuser=document.getElementById(`deleteuser_${e.id}`);
                deleteuser.addEventListener('click', async (de)=>{
    
                    const respuesta=await fetch(`${urlweb}/api/delete_user/${e.id}`,{
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
            userscontainer.innerHTML=`
            <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 w-100 justify-content-center align-items-center h-100'>
            
                <div class="p-3">
                    <img src="${urlweb}/Images/assets/empty.png" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                </div>
                <div>
                    <h5>No se han encontrado usuarios con esos filtros.</h5>
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
    
        const respuesta=await fetch(`${urlweb}/api/get_users`,{
            method: 'POST',
            body: formData
        });
        const datos=await respuesta.json();

        if(respuesta.ok){
            datos.users.forEach((e,i) => {
                const divchild=document.createElement('div');
                divchild.classList.add('col-12', 'col-xl-5', 'user-container', 'd-flex', 'rounded-4', 'position-relative', 'align-items-center', 'bg-graylight','divChild');

                divchild.innerHTML=`
                        <div class="d-flex h-100">    
                            <img src="${urlweb}/${e.image}" alt="1flat" class='rounded user_image object-fit-contain rounded-4 bg-graylight' style="width:6rem;">
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between text-start">
                            <h5 class="m-0 text-wrap text-break"><b>Nombre:</b> ${e.name}</h5>
                            <p class="m-0 py-2 text-wrap text-break"><b>Email:</b> ${e.email}</p>
                            <p class="m-0 text-wrap text-break"><b>Teléfono:</b> ${e.phone}</p>
                        </div>
                        <div class="dropdown position-absolute start-100 top-0">
                            <button class="btn rounded-circle border-0 whitetransparent d-flex justify-content-center align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>
                            <ul class="dropdown-menu col-6">
                                <li>
                                    <form action="${urlweb}/users/${e.id}/edit" method="get" class="dropdown-item px-0 col-8">
                                        <button type="submit" class="btn col-12 px-0 border-0"><i class="fa-solid fa-pen-to-square"></i>Editar</button>
                                    </form>
                                </li>
                                <li>
                                    <button type="submit" id="deleteuser_${e.id}" class="d-flex justify-content-center py-2 btn border-0 dropdown-item px-0 col-8"><i class="fa-solid fa-trash"></i>Eliminar</button>
                                </li>
                            </ul>
                        </div>`;

                userscontainer.appendChild(divchild);

                const deleteuser=document.getElementById(`deleteuser_${e.id}`);
                deleteuser.addEventListener('click', async (de)=>{
                    
                    const respuesta=await fetch(`${urlweb}/api/delete_user/${e.id}`,{
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
    }, 3000);

    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
        });
}