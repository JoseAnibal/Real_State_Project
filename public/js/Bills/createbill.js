document.addEventListener("DOMContentLoaded", function() {


    const sum=document.querySelectorAll('.sum');
    const calculate=document.querySelector('.calculate');
    const totaltopay=document.querySelector('.totaltopay');
    let total=0;

    calculate.addEventListener('click',(e)=>{
        e.preventDefault();
        total=0;
        (Array.from(sum)).forEach((e)=>{
            if(!isNaN(parseFloat(e.value))){
                total+=parseFloat(e.value);
            }
        });

        totaltopay.value=total;
        console.log(total);
    }); 


});