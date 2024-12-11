function cargarConfig() {
    fetch('./jsons/config.json') 
        .then(response => response.json())
        .then(data => {
            const configuraciones = data.configuraciones;
            const mensajeCammbio = configuraciones.find(config => config.clave === "mensaje_cambio").valor;
            const mensajeOperaciones = configuraciones.find(config => config.clave === "mensaje_operaciones").valor;
            const mensajeConfig = configuraciones.find(config => config.clave === "mensaje_config").valor;
            const mensajehomeIcon = configuraciones.find(config => config.clave === "mensaje_home").icono;
            const mensajeCammbioIcon = configuraciones.find(config => config.clave === "mensaje_cambio").icono;
            const mensajeOperacionesIcon = configuraciones.find(config => config.clave === "mensaje_operaciones").icono;
            const mensajeConfigIcon = configuraciones.find(config => config.clave === "mensaje_config").icono;
            const mensajehome = configuraciones.find(config => config.clave === "mensaje_home").valor;
            const mensajeTitulo = configuraciones.find(config => config.clave === "TituloPag").valor;
            document.getElementById("titulo_app").textContent = mensajeTitulo;

            document.getElementById("home").textContent = mensajehome;
            document.getElementById("tpcambio").textContent = mensajeCammbio;
            document.getElementById("operaciones").textContent = mensajeOperaciones;
            document.getElementById("configu").textContent = mensajeConfig;
            document.getElementById("homeIcon").className = mensajehomeIcon;
            document.getElementById("tpcambioIcon").className = mensajeCammbioIcon;
            document.getElementById("operacionesIcon").className = mensajeOperacionesIcon;
            document.getElementById("configuIcon").className = mensajeConfigIcon;
        })
        .catch(error => console.error("Error al cargar el mensaje de bienvenida:", error));
}


function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

function cargarPosts() {

    console.log("eweqweqweqweqweqweqwe")
    fetch('jsons/posts.json')
        .then(response => response.json())
        .then(posts => {

            const usuarioId = getCookie('usuario');  
            const usuarioIdDecodificado = decodeURIComponent(usuarioId);

            console.log(usuarioIdDecodificado)

            if (!usuarioId) {
                console.log("No se encontró el ID del usuario en las cookies");
                return;
            }

            const postsUsuario = posts.filter(post => post.usuario_id === usuarioIdDecodificado);

            const postsContainer = document.createElement('div');
            postsUsuario.forEach(post => {
                console.log(postsUsuario)
                const postCard = document.createElement('div');
                postCard.classList.add('card', 'mb-3');

                postCard.innerHTML = `
                    <img src="jsons/uploads/${post.imagen}" class="card-img-top" alt="${post.titulo}">
                    <div class="card-body">
                        <h5 class="card-title">${post.titulo}</h5>
                        <p class="card-text">${post.descripcion}</p>
                        <p class="card-text"><small class="text-muted">${post.fecha_creacion}</small></p>
                        <button class="btn btn-danger btn-sm" onclick="eliminarPost(${post.id})">Eliminar</button>

                    </div>
                `;

                postsContainer.appendChild(postCard);
            });

            const postsSection = document.getElementById('postsList');
            postsSection.innerHTML = '';
            postsSection.appendChild(postsContainer);
        })
        .catch(error => console.error("Error al cargar los posts:", error));
}




function eliminarPost(postId) {
    if (confirm('¿Estás seguro de que deseas eliminar este post?')) {
        fetch(`deletePost.php?id=${postId}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Post eliminado correctamente');
                cargarPosts(); 
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => console.error('Error al eliminar el post:', error));
    }
  }

document.addEventListener("DOMContentLoaded", () => {
    cargarConfig();
    cargarPosts()
});

document.getElementById('guardarPostBtn').addEventListener('click', function () {
    const titulo = document.getElementById('tituloPost').value;
    const descripcion = document.getElementById('descripcionPost').value;
    const imagen = document.getElementById('imagenPost').files[0]; 

    if (!titulo || !descripcion || !imagen) {
        alert("Todos los campos son obligatorios.");
        return;
    }

    const formData = new FormData();
    formData.append('titulo', titulo);
    formData.append('descripcion', descripcion);
    formData.append('imagen', imagen);

    fetch('guardar_post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Post guardado con éxito.");
            cargarPosts();

            window.location.href = 'Publicar.php'; 
        } else {
            alert("Error al guardar el post.");
        }
    })
    .catch(error => {
        console.error("Error al guardar el post:", error);
        alert("Ocurrió un error al guardar el post.");
    });
});
