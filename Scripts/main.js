function init (){
    themeSwitch();
}

function themeSwitch () {
    document.getElementById('btnSwitch').addEventListener('click',()=>{
        if (document.html.getAttribute('data-bs-theme') == 'dark') {
            document.documentElement.setAttribute('data-bs-theme','light')
        }
        else {
            document.html.setAttribute('data-bs-theme','dark')
        }
    })
}


init();