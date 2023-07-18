// Función para pedir datos de las máscotas del usuario logueado.
const pedirDatos = () => {
    // Se hace una petición GET a pets.php para pedir las mascotas registradas por el usuario
    fetch("pets.php", {
        method: "GET",
        "headers": {
            "Content-Type": "application/json",
        }
        // Si la petición es éxitosa, se recibe la respuesta y se procesa a JSON.
    }).then(response => response.json())
        .then(data => {
            divMascotas = document.getElementById('mascotas-registradas');
            divMascotas.innerHTML = '';
            // Si no tiene registrada ninguna, se muestra un aviso en la página
            if (data.length == 0) {
                let element = document.createElement("div");
                element.innerHTML = "<h2 class='seccion-subtitulo'>Usted no tiene ninguna máscota registrada</h2><h3>Registre su primer máscota ahora</h3>";
                console.log("Usted no tiene ninguna mascota");
                document.querySelector('.mascotas').insertBefore(element, document.querySelector('.mascotas').firstChild);
                document.getElementsByClassName('mascotas').insertBefore(element, document.getElementById('mascotas').firstChild);
            } else {
                // Si tiene al menos una mascota, se crea un div por cada una de ellas y se llena con los datos recibidos de la misma.
                for (let i = 0; i < data.length; i++) {
                    let element = document.createElement("div");
                    console.log(data[i]);
                    element.className = "mascota-registrada";
                    element.innerHTML = `<h2>${[data[i].Nombre]}</h2><img src="images/do.png"></img><p>${[data[i].Especie]}</p><p>${[data[i].Edad]}</p>`;
                    divMascotas.appendChild(element);
                }
            }
        })
        // Si no se pudo completar la petición, se muestra un error en consola
        .catch(error => console.log("Ha ocurrido un error al intentar recuperar sus mascotas registradas."));
};

const enviarDatos = () => {
    // Se toman los datos del formulario y se guardan en un objeto FormData
    let datos = new FormData(document.querySelector("#formulario"));

    // Se muestran en consola los valores a enviar del formulario
    for (const value of datos.values()) {
        console.log(value);
    }

    // Se realiza una petición POST a pets.php para guardar una nueva mascota en la BD.
    fetch("pets.php", {
        method: "POST",
        body: datos,
        // Si la petición es éxitosa, se recibe una respuesta y se procesa a texto plano.
    }).then(response => response.text())
        .then(result => console.log(result))
        .catch(() => console.log("Hubo un error al enviar los datos"));

    // Refresca la seccion de las mascotas registradas por el usuario
    pedirDatos();
}