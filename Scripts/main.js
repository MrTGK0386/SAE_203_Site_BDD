function init (){
    themeSwitch();
    btnFiltre();
}

function themeSwitch () {
    let button = document.getElementById('btnSwitch');
    let dad = document.documentElement;
    let state ;

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
function btnFiltre(){
    let e =document.getElementById("filter_Div");
    let vol= document.getElementById("bt_volcan");
    let sei = document.getElementById("bt_seisme");
    let met = document.getElementById("bt_meteor");

    vol.addEventListener('click', () =>{
        var url = 'formVolcan.php';
        fetch(url)
            .then(function (response){
                if (!response.ok) {
                    throw new Error('Erreur lors du chargement du contenu PHP');
                }
                return response.text();
            })
            .then(function (data){
                e.innerHTML = data;
            })
            .catch(function (error){
                console.log(error);
            })
    })

    sei.addEventListener('click', () =>{
        var url = 'formSeisme.php';
        fetch(url)
            .then(function (response){
                if (!response.ok) {
                    throw new Error('Erreur lors du chargement du contenu PHP');
                }
                return response.text();
            })
            .then(function (data){
                e.innerHTML = data;
            })
            .catch(function (error){
                console.log(error);
            })
    })

    met.addEventListener('click', () =>{
        var url = 'formMeteor.php';
        fetch(url)
            .then(function (response){
                if (!response.ok) {
                    throw new Error('Erreur lors du chargement du contenu PHP');
                }
                return response.text();
            })
            .then(function (data){
                e.innerHTML = data;
            })
            .catch(function (error){
                console.log(error);
            })
    })

}


init();