let counter = document.getElementById('redirect');
let count = 1;

setInterval(()=>{
    count++

    if(count > 5) location.replace('../index.php');
},1000);
