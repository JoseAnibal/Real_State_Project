document.addEventListener("DOMContentLoaded", function() {

    // const switchrental = document.querySelector('#flexSwitchCheckDefault');

    let switchInput = document.getElementById('flexSwitchCheckDefault');
    let switchLabel = document.querySelector('.form-check-label');

    const check=document.querySelector('#checkactive');

    if(check.value){
        switchInput.checked=true;
    }

    switchInput.addEventListener('change', function() {
        if (this.checked) {
            switchLabel.textContent = 'Alquiler activo';
            check.value=1;
        } else {
            switchLabel.textContent = 'Alquiler desactivado';
            check.value=0;
        }
    });

});