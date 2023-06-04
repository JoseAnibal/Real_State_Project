"use strict"

const incidencescontainer=document.querySelector('#incidencescontainer');
const cargando=document.querySelector(".cargando");
let urlweb=(window.location.href).split('/').slice(0,3).join('/');
const viewmore=document.querySelector('.viewmore');
let click=0;
let incidencestatus={
    0:"<i class='fa-regular fa-circle fa-lg' style='color: #7ceef8;'></i> Creada",
    1:"<i class='fa-solid fa-spinner fa-lg' style='color: #fbcf7d;'></i> En curso",
    2:"<i class='fa-solid fa-xmark fa-xl' style='color: #fe8386;'></i> Rechazada",
    3:"<i class='fa-solid fa-check fa-xl' style='color: #80ff86;'></i> Finalizada"
};

filterData();
initData();

const filterbtn=document.querySelector('.filter');
filterbtn.addEventListener('click', ()=>{
    incidencescontainer.innerHTML='';
    click=0;
    initData();
});

async function initData(){
    const form=document.querySelector("#filters");
    form.preventDefault;
    const formData=new FormData(form);

    cargando.classList.remove('hide');
    const respuesta=await fetch(`${urlweb}/api/get_incidences`,{
        method: 'POST',
        body: formData
    });
    const datos=await respuesta.json();

    if(respuesta.ok){
        
        if(datos.incidences.length){
            datos.incidences.forEach((e,i) => {
                const divchild=document.createElement('div');
                divchild.classList.add('rounded-4', 'property_card', 'my-3', 'mx-auto', 'mx-md-0', 'px-0', 'col-6', 'd-flex', 'justify-content-center','divChild');

                divchild.innerHTML=`
                <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">
                    <a href="${urlweb}/incidences/${e.id}">
                        <img src="${urlweb}/${e.image_url}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                    </a>
                    <div class="card-body d-flex flex-column px-0">
                        <a href="${urlweb}/incidences/${e.id}" class="text-black">
                            <h5 class="card-title text-start"><b>${e.title}</b></h5>
                        </a>
                        <p class="card-text text-start property-desc">${e.description}</p>
                        <p class="card-text text-start property-desc">${incidencestatus[e.status]}</p>
                    </div>
                    <div class="border-0 p-0 d-flex justify-content-end">
                        <p class="card-text text-start property-desc">${e.date}</p>
                    </div>
                </div>  
                `;
                incidencescontainer.appendChild(divchild);
            });
            
            viewmore.classList.remove('hide');
        }else{
            incidencescontainer.innerHTML=`
            <div class='d-flex col-10 rounded-4 bg-graylight flex-column h-100 justify-content-center align-items-center h-100 w-100'>
            
                <div class="p-3">
                    <img src="${urlweb}/Images/assets/empty.png" alt="1flat" class='rounded user_image object-fit-contain rounded-4' style="width:8rem;background-color: #F3F3F3">
                </div>
                <div>
                    <h5>No se han encontrado incidencias con esos filtros.</h5>
                </div>
            
            </div>`;
            viewmore.classList.add('hide');
        }
        cargando.classList.add('hide');
    }else{
        console.log(datos);
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
    
        const respuesta=await fetch(`${urlweb}/api/get_incidences`,{
            method: 'POST',
            body: formData
        });
        const datos=await respuesta.json();

        if(respuesta.ok){
            datos.incidences.forEach((e,i) => {
                const divchild=document.createElement('div');
                divchild.classList.add('rounded-4', 'property_card', 'my-3', 'mx-auto', 'mx-md-0', 'px-0', 'col-6', 'd-flex', 'justify-content-center','divChild');

                divchild.innerHTML=`
                                <div class="card col-11 border-0 p-2 rounded-4" style="width: 16rem; background-color: #e4e3e3">
                                <a href="${urlweb}/incidences/${e.id}">
                                    <img src="${urlweb}/${e.image_url}" alt="1flat" class='card-img-top w-100 rounded property_image object-fit-cover rounded-4 col-12'>
                                </a>
                                <div class="card-body d-flex flex-column px-0">
                                    <a href="${urlweb}/incidences/${e.id}" class="text-black">
                                        <h5 class="card-title text-start"><b>${e.title}</b></h5>
                                    </a>
                                    <p class="card-text text-start property-desc">${e.description}</p>
                                    <p class="card-text text-start property-desc">${incidencestatus[e.status]}</p>
                                </div>
                                <div class="border-0 p-0 d-flex justify-content-end">
                                <p class="card-text text-start property-desc">${e.date}</p>
                                </div>
                            </div>`;
                incidencescontainer.appendChild(divchild);
            });
            cargando.classList.add('hide');
        }
    });
}

function showAlert(message, type) {

    const alert = document.createElement('div');
    alert.classList.add('alert', `alert-${type}`, 'fade', 'show');

    alert.innerText = message;

    const container = document.querySelector('.container');
    container.insertBefore(alert, container.firstChild);

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