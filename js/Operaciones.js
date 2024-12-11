function cargarPosts() {
    fetch('jsons/posts.json')
        .then(response => response.json())
        .then(posts => {
            const postsContainer = document.createElement('div');
            
            posts.forEach(post => {
                const postCard = document.createElement('div');
                postCard.classList.add('card', 'mb-3');

                postCard.innerHTML = `
                    <img src="jsons/uploads/${post.imagen}" class="card-img-top" alt="${post.titulo}">
                    <div class="card-body">
                        <h5 class="card-title">${post.titulo}</h5>
                        <p class="card-text">${post.descripcion}</p>
                        <p class="card-text"><small class="text-muted">${post.fecha_creacion}</small></p>
                        <p class="card-text"><small class="text-muted">${post.usuario_id}</small></p>

                        
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

document.addEventListener("DOMContentLoaded", () => {
    cargarConfig();
    cargarPosts();
});

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