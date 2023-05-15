"use strict"

document.addEventListener("DOMContentLoaded", function() {

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
        const walk = (x - startX) * 1; // Controla la velocidad del desplazamiento
        contenedor.scrollLeft = scrollLeft - walk;
    });

    const clickable=document.querySelectorAll(".clickable");
    const carouselitem=document.querySelectorAll(".carousel-item");

    //REMOVE DRAGGABLE IMAGE EVENT
    clickable.forEach((e,i)=>{
        e.addEventListener('dragstart',(el)=>{
            el.preventDefault();
        });
    });

    //SET IMAGE ON CARROUSEL
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