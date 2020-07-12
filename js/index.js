(function() {
    cities();
    types();
	render();
	
})();

/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
    $(this).scroll(function() {
        var $this = $(this);
        if ($this.data('scrollTimeout')) {
            clearTimeout($this.data('scrollTimeout'));
        }
        $this.data('scrollTimeout', setTimeout(callback, timeout));
    });
};
/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider() {
    $("#rangoPrecio").ionRangeSlider({
        type: "double",
        grid: false,
        min: 0,
        max: 100000,
        from: 200,
        to: 80000,
        prefix: "$"
    });
}
/*
  Función que reproduce el video de fondo al hacer scroll, y deteiene la reproducción al detener el scroll
*/
function playVideoOnScroll() {
    var ultimoScroll = 0,
        intervalRewind;
    var video = document.getElementById('vidFondo');
    $(window)
        .scroll((event) => {
            var scrollActual = $(window).scrollTop();
            if (scrollActual > ultimoScroll) {

            } else {
                //this.rewind(1.0, video, intervalRewind);
                video.play();
            }
            ultimoScroll = scrollActual;
        })
        .scrollEnd(() => {
            video.pause();
        }, 10)
}

function cities() {
    fetch('http://127.0.0.1/prueba/web.php?c=Main&f=distinctCities')
        .then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            const data = Object.values(myJson);
            const el = document.querySelector('#selectCiudad');
            data.forEach(element => {
                let option = new Option(element, element);
                el.appendChild(option);
            });
        });
}

function types() {
    fetch('http://127.0.0.1/prueba/web.php?c=Main&f=distinctTypes')
        .then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            const data = Object.values(myJson);
            const el = document.querySelector('#selectTipo');
            data.forEach(element => {
                let option = new Option(element, element);
                el.appendChild(option);
            });
        });
}

function render(c = "Main",f = "all",params = "",selector = '.tituloContenido.card' ) {
    function htmlTemplate(template) {
        let container = document.createElement('div');
		container.innerHTML = template;
		container.classList.add("rs-div");
        return container;
    }
	let parent = document.querySelector(selector);
    fetch(`http://127.0.0.1/prueba/web.php?c=${c}&f=${f}&${params}`)
        .then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            let {
                data,
                template
			} = myJson;
			let container = document.createElement('div');
			console.log(data);
			container.classList.add("rs-container");
            data.forEach(element => {
                let html = htmlTemplate(template);
				html.querySelector('.address').innerHTML     = `<b>Direccion</b>     : ${element.Direccion}`;
				html.querySelector('.address').dataset.address = element.Direccion;
				html.querySelector('.city').innerHTML        = `<b>Ciudad</b>        : ${element.Ciudad}`;
				html.querySelector('.city').dataset.city = element.Ciudad;
				html.querySelector('.phone').innerHTML       = `<b>Telefono</b>      : ${element.Telefono}`;
				html.querySelector('.phone').dataset.phone = element.Telefono;
				html.querySelector('.postal_code').innerHTML = `<b>Codigo Postal</b> : ${element.Codigo_Postal}`;
				html.querySelector('.postal_code').dataset.postal_code = element.Codigo_Postal;
				html.querySelector('.type').innerHTML        = `<b>Tipo</b>          : ${element.Tipo}`;
				html.querySelector('.type').dataset.type = element.Tipo;
				html.querySelector('.price').innerHTML       = `<b>Precio</b>        : ${element.Precio}`;
				html.querySelector('.price').dataset.price = element.Precio;
                container.appendChild(html);
			});
			parent.innerHTML = "";
			parent.appendChild(container);
        });

}



function saveRealState(event) {
	const parent = $(event.target).closest('.rs-div');
	let data = {
		address    : $(parent).find('.address').data('address'),
		city       : $(parent).find('.city').data('city'),
		phone      : $(parent).find('.phone').data('phone'),
		postal_code: $(parent).find('.postal_code').data('postal_code'),
		type       : $(parent).find('.type').data('type'),
		price      : $(parent).find('.price').data('price'),
	};

	fetch('http://127.0.0.1/prueba/web.php?c=Main&f=saveUserRealState', {
			method: 'POST',
			headers: {
			'Accept': 'application/json',
			'Content-Type': 'form-data'
			},
			body: JSON.stringify(data)
		})
        .then(function(response) {
            return response.json();
        })
        .then(function(myJson) {
            
        });
}


$(document).on('click','.saveRealState',function (event) {
	saveRealState(event);
});

inicializarSlider();
playVideoOnScroll();