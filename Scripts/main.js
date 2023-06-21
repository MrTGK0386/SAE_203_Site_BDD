function init (){
    headerGen();
}

function headerGen (){
    let username = "<?php echo $_SESSION['username']; ?>";
    console.log(username)
}

init();