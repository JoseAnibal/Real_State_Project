"use strict"

document.addEventListener("DOMContentLoaded", function() {
      
      async function initMap() {
        const url=window.location.href;
        const idproperty=url.split("/")[4];

        const respuesta=await fetch('http://127.0.0.1:8000/api/get_coords/'+idproperty,{
                method: 'GET'
        });

        const datos=await respuesta.json();

        if(respuesta.ok){

            //MAKE THE POSITION OF THE CIRCLE A BIT RANDOM
            let lati=parseFloat(datos.coords.split(',')[0])+(Math.random() * 0.0005 - 0.0000) + 0.0000;
            let long=parseFloat(datos.coords.split(',')[1])-(Math.random() * 0.0006 - 0.0000) + 0.0000;

            const citymap = {
                property: {
                  center: { lat: lati, lng: long },
                  population: 1,
                }
            };
    
            // Create the map.
            const map = new google.maps.Map(document.getElementById("map"), {
              zoom: 17,
              center: { lat: lati, lng: long }
            });
          
            // Construct the circle for each value in citymap.
            // Note: We scale the area of the circle based on the population.
            for (const city in citymap) {
              // Add the circle for this city to the map.
              const cityCircle = new google.maps.Circle({
                strokeColor: "#0074ff",
                strokeOpacity: 0.4,
                strokeWeight: 2,
                fillColor: "#0074ff",
                fillOpacity: 0.35,
                map,
                center: citymap[city].center,
                radius: Math.sqrt(citymap[city].population) * 100,
              });
            }
        }

      }
      
      window.initMap = initMap();

    const contenedor = document.querySelector('.withscroll');
    let isMouseDown = false;
    let startX;
    let scrollLeft;

    contenedor.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.pageX - contenedor.offsetLeft;
        scrollLeft = contenedor.scrollLeft;
    });

    contenedor.addEventListener('mouseup', () => {
        isMouseDown = false;
    });

    contenedor.addEventListener('mousemove', (e) => {
        if (!isMouseDown) return;
        e.preventDefault();
        const x = e.pageX - contenedor.offsetLeft;
        const walk = (x - startX) * 1;
        contenedor.scrollLeft = scrollLeft - walk;
    });

    const clickable=document.querySelectorAll(".clickable");
    const carouselitem=document.querySelectorAll(".carousel-item");

    clickable.forEach((e,i)=>{
        e.addEventListener('dragstart',(el)=>{
            el.preventDefault();
        });
    });

    clickable.forEach((e,i)=>{
        e.addEventListener('click',(el)=>{
            carouselitem.forEach((e,i)=>{
                e.classList.remove('active');
            });
            carouselitem[i].classList.add('active');

            clickable.forEach((e,i)=>{
                e.classList.remove('selectedimg');
            });
            e.classList.add('selectedimg');
        });
    });

});