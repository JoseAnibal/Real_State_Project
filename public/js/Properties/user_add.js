document.addEventListener('DOMContentLoaded', function() {
    
    "use strict"
    const userscontainer=document.querySelector('#userscontainer');
    const cargando=document.querySelector(".cargando");
    const viewmore=document.querySelector('.viewmore');
    let urlweb=(window.location.href).split('/').slice(0,3).join('/');
    let propertyid=(window.location.href).split('/').slice(-1)[0];

    let click=0;

    console.log(urlweb);
    addUser();
    initData();
    filterData();

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
        const respuesta=await fetch(`${urlweb}/api/get_norental_users`,{
            method: 'POST',
            body: formData
        });
        const datos=await respuesta.json();

        if(respuesta.ok){
            
            if(datos.users.length){
                datos.users.forEach((e,i) => {
                    const divchild=document.createElement('div');
                    divchild.classList.add('col-12', 'user-container', 'd-flex', 'rounded-4', 'position-relative', 'align-items-center', 'bg-graylight','divChild');
        
                    divchild.innerHTML=`
                        <div class="d-flex h-100">    
                            <img src="${urlweb}/${e.image}" alt="1flat" class='rounded user_image object-fit-contain rounded-4 bg-graylight' style="width:6rem;">
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between text-start">
                            <h5 class="m-0 text-wrap text-break"><b>Nombre:</b> ${e.name}</h5>
                            <p class="m-0 py-2 text-wrap text-break"><b>Email:</b> ${e.email}</p>
                            <p class="m-0 text-wrap text-break"><b>Teléfono:</b> ${e.phone}</p>
                        </div>
                        <div class="position-absolute checkuser_${e.id}" style="top: 0;right: 4px;">

                        </div>`;
                    userscontainer.appendChild(divchild);

                    const checkuser=document.querySelector(`.checkuser_${e.id}`);
                    const test=document.createElement('input');
                    test.type='checkbox';
                    test.name=`check`;
                    test.value=`${e.id}`;
                    test.classList.add("form-check-input", "rounded-circle");
                    test.style="scale: 1.3;";
                    checkuser.appendChild(test);
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
        
            const respuesta=await fetch(`${urlweb}/api/get_norental_users`,{
                method: 'POST',
                body: formData
            });
            const datos=await respuesta.json();

            if(respuesta.ok){
                datos.users.forEach((e,i) => {
                    const divchild=document.createElement('div');
                    divchild.classList.add('col-12', 'user-container', 'd-flex', 'rounded-4', 'position-relative', 'align-items-center', 'bg-graylight','divChild');

                    divchild.innerHTML=`
                        <div class="d-flex h-100">    
                            <img src="${urlweb}/${e.image}" alt="1flat" class='rounded user_image object-fit-contain rounded-4 bg-graylight' style="width:6rem;">
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between text-start">
                            <h5 class="m-0 text-wrap text-break"><b>Nombre:</b> ${e.name}</h5>
                            <p class="m-0 py-2 text-wrap text-break"><b>Email:</b> ${e.email}</p>
                            <p class="m-0 text-wrap text-break"><b>Teléfono:</b> ${e.phone}</p>
                        </div>
                        <div class="position-absolute checkuser_${e.id}" style="top: 0;right: 4px;">
                            
                        </div>`;
                    userscontainer.appendChild(divchild);

                    const checkuser=document.querySelector(`.checkuser_${e.id}`);
                    const test=document.createElement('input');
                    test.type='checkbox';
                    test.name=`check`;
                    test.value=`${e.id}`;
                    test.classList.add("form-check-input", "rounded-circle");
                    test.style="scale: 1.3;";
                    checkuser.appendChild(test);
            });
                cargando.classList.add('hide');
            }
        });
    }

    function addUser(){
        cargando.classList.remove('hide');
        const addusers=document.querySelector('.addusers');

        addusers.addEventListener('click', async ()=>{
            const usersform=document.querySelector('#usersform');
            const formDataUsers=new FormData(usersform);
            // console.log([...formDataUsers.values()].length);

            //If formdata is not empty do fetch
            if([...formDataUsers.values()].length){
                const dates=document.querySelector('#dates');
                const formDataDates=new FormData(dates);
                const arrayDates=Array.from(formDataDates.values());

                const dateempty=!arrayDates.every(function(element) {
                    return element !== "";
                });

                if(!dateempty){
                    let idusersadded=(Array.from(formDataUsers.values())).join(',');
                    const finalForm=new FormData();
                    finalForm.append('idusers',idusersadded);
                    finalForm.append('datestart',arrayDates[0]);
                    finalForm.append('dateend',arrayDates[1]);

                    const respuesta=await fetch(`${urlweb}/api/process_rental/${propertyid}`,{
                        method: 'POST',
                        body: finalForm
                    });
                    const datos=await respuesta.json();

                    if(respuesta.ok){
                        const check= document.querySelector('.check');
                        const loading= document.querySelector('.loading');
                        cargando.classList.remove('hide');
                        loading.classList.add('hide');
                        check.classList.remove('hide');
                        setTimeout(function() {
                            check.classList.remove('show');
                            loading.classList.remove('hide');
                            check.classList.add('hide');
                            cargando.classList.add('hide');
                            window.location.href = `/user_list/${propertyid}`;
                        }, 3000);
                    }

                }else{
                    showAlert("Falta una fecha","warning");
                }

            }else{
                showAlert("No se ha seleccionado ningun usuario","warning");
            }

        });
    }

    function showAlert(message, type) {

        const alert = document.createElement('div');
        alert.classList.add('alert', `alert-${type}`, 'fade', 'show', 'col-10');

        alert.innerText = message;

        const container = document.querySelector('.container');
        container.insertBefore(alert, container.firstChild);

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

});
  