function init (){
    themeSwitch();
}

function themeSwitch () {
    let button = document.getElementById('btnSwitch');
    let dad = document.documentElement;
    let state ;
    window.addEventListener('load', () =>{
        if (dad.getAttribute('data-bs-theme') != state){
            if (state == 'light') {
                state = dad.getAttribute('data-bs-theme');
                dad.setAttribute('data-bs-theme','light');
                button.classList.add("btn-secondary");
                button.classList.remove("btn-light");
                document.getElementById("icoSwtch").setAttribute('icon','ph:sun-bold');
            }
            else {
                state = dad.getAttribute('data-bs-theme');
                dad.setAttribute('data-bs-theme','dark');
                button.classList.add("btn-light");
                button.classList.remove("btn-secondary");
                document.getElementById("icoSwtch").setAttribute('icon','ph:moon-bold');
            }
        }
    })

    button.addEventListener('click',()=>{
        if (dad.getAttribute('data-bs-theme') == 'dark') {
            state = dad.getAttribute('data-bs-theme');
            dad.setAttribute('data-bs-theme','light');
            button.classList.add("btn-secondary");
            button.classList.remove("btn-light");
            document.getElementById("icoSwtch").setAttribute('icon','ph:sun-bold');
        }
        else {
            state = dad.getAttribute('data-bs-theme');
            dad.setAttribute('data-bs-theme','dark');
            button.classList.add("btn-light");
            button.classList.remove("btn-secondary");
            document.getElementById("icoSwtch").setAttribute('icon','ph:moon-bold');
        }
    })
}


init();