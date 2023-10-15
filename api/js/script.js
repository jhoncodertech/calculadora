// URL de la API Cliente
const apiBaseUrl = 'http://localhost:8080/api/models/Cliente.php';

// Función para cargar la lista de clientes
function loadClientList() {
    fetch(apiBaseUrl)
        .then(response => response.json())
        .then(data => {
            const clientList = document.getElementById('client-list');
            clientList.innerHTML = ''; // Limpiar la lista antes de agregar elementos

            data.forEach(client => {
                const listItem = document.createElement('li');
                listItem.textContent = `${client.id} - ${client.nombre} ${client.ap} ${client.am} - ${client.fn} - ${client.genero}`;

                const editButton = document.createElement('button');
                editButton.textContent = 'Editar';
                editButton.addEventListener('click', () => editClient(client));

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Eliminar';
                deleteButton.addEventListener('click', () => deleteClient(client.id));

                listItem.appendChild(editButton);
                listItem.appendChild(deleteButton);
                clientList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Función para crear un nuevo cliente
document.getElementById('create-client-form').addEventListener('submit', event => {
    event.preventDefault();
    const formData = new FormData(event.target);
    const clientData = {
        nombre: formData.get('nombre'),
        ap: formData.get('ap'),
        am: formData.get('am'),
        fn: formData.get('fn'),
        genero: formData.get('genero'),
    };

    fetch(apiBaseUrl, {
        method: 'POST',
        body: JSON.stringify(clientData),
        headers: {
            'Content-Type': 'application/json',
        },
    })
        .then(response => response.json())
        .then(data => {
            loadClientList();
            event.target.reset(); // Limpiar el formulario
        })
        .catch(error => console.error('Error:', error));
});

// Función para editar un cliente
function editClient(client) {
    const editForm = document.getElementById('edit-client-form');
    const idInput = document.getElementById('edit-client-id');
    idInput.value = client.id;

    editForm.querySelector('input[name="nombre"]').value = client.nombre;
    editForm.querySelector('input[name="ap"]').value = client.ap;
    editForm.querySelector('input[name="am"]').value = client.am;
    editForm.querySelector('input[name="fn"]').value = client.fn;
    editForm.querySelector('select[name="genero"]').value = client.genero;

    // Mostrar el formulario de edición
    editForm.style.display = 'block';

    editForm.addEventListener('submit', event => {
        event.preventDefault();
        const formData = new FormData(editForm);
        const editedClient = {
            id: formData.get('id'),
            nombre: formData.get('nombre'),
            ap: formData.get('ap'),
            am: formData.get('am'),
            fn: formData.get('fn'),
            genero: formData.get('genero'),
        };

        fetch(apiBaseUrl, {
            method: 'PUT',
            body: JSON.stringify(editedClient),
            headers: {
                'Content-Type': 'application/json',
            },
        })
            .then(response => response.json())
            .then(data => {
                loadClientList();
                editForm.style.display = 'none'; // Ocultar el formulario de edición
            })
            .catch(error => console.error('Error:', error));
    });
}

// Función para eliminar un cliente
function deleteClient(clientId) {
    fetch(`${apiBaseUrl}?id=${clientId}`, {
        method: 'DELETE',
    })
        .then(response => response.json())
        .then(data => {
            loadClientList();
        })
        .catch(error => console.error('Error:', error));
}

// Cargar la lista de clientes al cargar la página
loadClientList();
