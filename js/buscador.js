function search() {
    const city  = document.querySelector('#selectCiudad').value;
    const type  = document.querySelector('#selectTipo').value;
    const price = document.querySelector('#rangoPrecio').value;
    render("Search","filter",`city=${city}&type=${type}&price=${price}`);

}

document.querySelector('#submitButton').addEventListener('click',(event)=>{
    event.preventDefault();
    search();
});

$( "#tabs" ).on("tabsactivate", function( event, ui ) {
    const { selector } = ui.newPanel;
    if(selector == "#tabs-2"){
        render("Main","userRealState","","#userRealState");
    }
});




