function attachEventListeners() {
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', () => openEditModal(btn.dataset.id));
    });

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', () => deleteVehicle(btn.dataset.id));
    });
}

async function openEditModal(id) {
    const response = await fetch(`../clientPages/AJAX/getVehicle.php?id_vehicle=${id}`);
    const vehicle = await response.json();
    console.log(vehicle);
    editId.value = vehicle[0].id;
    editModel.value = vehicle[0].model;
    editBrand.value = vehicle[0].brand;
    editPrice.value = vehicle[0].price;
    editLocation.value = vehicle[0].location;
    editAvailable.value = vehicle[0].available ? '1' : '0';
    editCategory.value = vehicle[0].idCategory.toString();
    editDescription.value = vehicle[0].description;
    editImgUrl.value = vehicle[0].imgUrl;

    editModal.classList.remove('hidden');

    editForm.addEventListener("submit",function(event){
        event.preventDefault();
    
        const formData = new FormData(this);

        fetch('../clientPages/AJAX/vehicle.php?edit&id_vehicle='+id, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location = "vehiclesAdmin.php";
            }
        })
    })
}


closeModal.addEventListener('click', () => {
    editModal.classList.add('hidden');
});


async function deleteVehicle(id) {
    if (confirm('Are you sure you want to delete this vehicle?')) {
        await fetch(`../clientPages/AJAX/vehicle.php?del&id_vehicle=`+id);
        location.reload();
    }
}


attachEventListeners();





openAddModal.addEventListener('click', () => {
    addModal.classList.remove('hidden');
});


closeAddModal.addEventListener('click', () => {
    addModal.classList.add('hidden');
});

addForm.addEventListener('submit', async function(event){
    event.preventDefault();

    const formData = new FormData(this);

    const response = await fetch('../clientPages/AJAX/vehicle.php?add', {
        method: 'POST',
        body: formData,
    });

    if (response.ok) {
        alert('Vehicle added successfully!');
        addModal.classList.add('hidden');
    } else {
        alert('Failed to add vehicle.');
    }
});