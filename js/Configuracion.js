function cargarConfig() {
    fetch("./jsons/config.json")
      .then((response) => response.json())
      .then((data) => {
        const configuracionesObj = data.configuraciones.reduce((acc, config) => {
          acc[config.clave] = config;
          return acc;
        }, {});
  
        document.getElementById("logoFileInput").addEventListener("change", function (event) {
          const file = event.target.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById("logoPreview").src = e.target.result;
            };
            reader.readAsDataURL(file);
          }
        });
  
        document.getElementById("tituloInput").value = configuracionesObj["TituloPag"].valor;
        document.getElementById("bienvenidaInput").value = configuracionesObj["mensaje_bienvenida"].valor;
        document.getElementById("homeInput").value = configuracionesObj["mensaje_home"].valor;
        document.getElementById("cambioInput").value = configuracionesObj["mensaje_cambio"].valor;
        document.getElementById("operacionesInput").value = configuracionesObj["mensaje_operaciones"].valor;
        document.getElementById("configInput").value = configuracionesObj["mensaje_config"].valor;
        document.getElementById("logoInput").value = configuracionesObj["ImagenInicio"].valor;
  
        document.getElementById("titulo_app").textContent = configuracionesObj["TituloPag"].valor;
        document.getElementById("home").textContent = configuracionesObj["mensaje_home"].valor;
        document.getElementById("tpcambio").textContent = configuracionesObj["mensaje_cambio"].valor;
        document.getElementById("operaciones").textContent = configuracionesObj["mensaje_operaciones"].valor;
        document.getElementById("configu").textContent = configuracionesObj["mensaje_config"].valor;
  
        document.getElementById("logoPreview").src = configuracionesObj["ImagenInicio"].valor;
  


       
        document.getElementById("homeIcon").className = configuracionesObj["mensaje_home"].icono;
        document.getElementById("tpcambioIcon").className = configuracionesObj["mensaje_cambio"].icono;
        document.getElementById("operacionesIcon").className = configuracionesObj["mensaje_operaciones"].icono;
        document.getElementById("configuIcon").className = configuracionesObj["mensaje_config"].icono;

     


        const homeIcon = configuracionesObj["mensaje_home"].icono;
        const cambioIcon = configuracionesObj["mensaje_cambio"].icono;
        const operacionesIcon = configuracionesObj["mensaje_operaciones"].icono;
        const configIcon = configuracionesObj["mensaje_config"].icono;
  
        updateIconPreview("homeIconPreview", homeIcon);
        updateIconPreview("cambioIconPreview", cambioIcon);
        updateIconPreview("operacionesIconPreview", operacionesIcon);
        updateIconPreview("configIconPreview", configIcon);
  
        // Actualiza los selects con el icono actual
        document.getElementById("homeIconInput").value = homeIcon;
        document.getElementById("cambioIconInput").value = cambioIcon;
        document.getElementById("operacionesIconInput").value = operacionesIcon;
        document.getElementById("configIconInput").value = configIcon;
      })
      .catch((error) => {
        console.error("Error al cargar el archivo JSON:", error);
      });
  }
  
  function updateIconPreview(iconPreviewId, selectedValue) {
    const iconPreviewElement = document.getElementById(iconPreviewId);
    iconPreviewElement.className = selectedValue;
  }
  
  function guardarConfiguracion() {
    const data = new FormData();
  
    data.append("titulo", document.getElementById("tituloInput").value);
    data.append("mensaje_bienvenida", document.getElementById("bienvenidaInput").value);
    data.append("mensaje_home", document.getElementById("homeInput").value);
    data.append("mensaje_cambio", document.getElementById("cambioInput").value);
    data.append("mensaje_operaciones", document.getElementById("operacionesInput").value);
    data.append("mensaje_config", document.getElementById("configInput").value);
  
    data.append("home_icon", document.getElementById("homeIconInput").value);
    data.append("cambio_icon", document.getElementById("cambioIconInput").value);
    data.append("config_icon", document.getElementById("configIconInput").value);
    data.append("operaciones_icon", document.getElementById("operacionesIconInput").value);
  
    const logoFileInput = document.getElementById("logoFileInput");
    if (logoFileInput.files.length > 0) {
      data.append("logoFileInput", logoFileInput.files[0]);
    }
  
    const loadingMessage = document.createElement("div");
    loadingMessage.textContent = "Guardando configuraciones...";
    document.body.appendChild(loadingMessage);
  
    fetch("saveConfig.php", {
      method: "POST",
      body: data,
    })
      .then((response) => response.text())
      .then((result) => {
        document.body.removeChild(loadingMessage);
        if (result === "success") {
          alert("Configuración guardada correctamente.");
        } else {
          alert("Error al actualizar la configuración: " + result);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Hubo un problema al procesar la solicitud. Detalles: " + error.message);
      });
  }
  
  document.addEventListener("DOMContentLoaded", () => {
    cargarConfig();
  });
  