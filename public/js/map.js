let map, marker;
let lat = 14.6349, lng = -90.5069; // Coordenadas iniciales

function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat, lng },
        zoom: 14,
    });

    marker = new google.maps.Marker({
        position: { lat, lng },
        map,
        draggable: true,
    });

    // Actualizar las coordenadas cuando el usuario mueve el marcador
    marker.addListener('dragend', function() {
        const position = marker.getPosition();
        lat = position.lat();
        lng = position.lng();
    });
}

// Manejo del botón "Confirmar ubicación"
document.getElementById('confirmLocationButton').addEventListener('click', function () {
    fetch('/guardar-direccion', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ latitud: lat, longitud: lng })
    })
    .then(response => response.json())
    .then(data => {
        alert('Dirección guardada con éxito');
        location.reload(); // Recargar la página para mostrar la dirección guardada
    })
    .catch(error => console.error('Error al guardar la dirección:', error));
});
