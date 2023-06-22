function init (){
    themeSwitch();
}

function themeSwitch () {
    let button = document.getElementById('btnSwitch');
    button.addEventListener('click',()=>{
        if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
            document.documentElement.setAttribute('data-bs-theme','light');
            button.classList.add("btn-secondary");
            button.classList.remove("btn-light");
            document.getElementById("icoSwtch").setAttribute('icon','ph:sun-bold');
        }
        else {
            document.documentElement.setAttribute('data-bs-theme','dark');
            button.classList.add("btn-light");
            button.classList.remove("btn-secondary");
            document.getElementById("icoSwtch").setAttribute('icon','ph:moon-bold');
        }
    })
}


init();