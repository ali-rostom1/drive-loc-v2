function attachEventListeners() {
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', () => openEditModal(btn.dataset.id));
    });

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', () => deleteVehicle(btn.dataset.id));
    });
}

async function openEditModal(id) {
    const response = await fetch(`../clientPages/AJAX/category.php?get&id_cat=${id}`);
    const cat = await response.json();
    
    editId.value = cat.id;
    editName.value = cat.name_cat;
    editDescription.value = cat.desc_cat;
    editImgUrl.value = cat.img_url;

    editModal.classList.remove('hidden');

    editForm.addEventListener("submit",function(event){
        event.preventDefault();
    
        const formData = new FormData(this);

        fetch('../clientPages/AJAX/category.php?edit&id_cat='+id, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location = "categoriesAdmin.php";
            }
        })
    })
}


closeModal.addEventListener('click', () => {
    editModal.classList.add('hidden');
});


async function deleteVehicle(id) {
    if (confirm('Are you sure you want to delete this vehicle?')) {
        await fetch(`../clientPages/AJAX/category.php?del&id_cat=`+id);
        location.reload();
    }
}





    
    

attachEventListeners();
