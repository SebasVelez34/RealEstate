function search() {
    fetch('http://127.0.0.1/prueba/web.php?c=Search&f=all')
    .then(function(response) {
        return response.json();
    })
    .then(function(myJson) {
        console.log(myJson);
    });
}