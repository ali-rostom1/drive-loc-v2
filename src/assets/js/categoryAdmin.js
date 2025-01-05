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


openAddModal.addEventListener('click', () => {
    addModal.classList.remove('hidden');
});


closeAddModal.addEventListener('click', () => {
    addModal.classList.add('hidden');
});

addForm.addEventListener('submit', async function(event){
    event.preventDefault();

    const formData = new FormData(this);

    const response = await fetch('../clientPages/AJAX/category.php?add', {
        method: 'POST',
        body: formData,
    });

    if (response.ok) {
        addModal.classList.add('hidden');
        location.reload();
    } else {
        alert('Failed to add category.');
    }
});


dynamicAdd.addEventListener("click",function(){
    const newCategoryDiv = document.createElement('div');

    newCategoryDiv.innerHTML += `
                        <div class="mt-10">
                            <label for="addName" class="block text-sm font-medium">Name</label>
                            <input type="text" id="addName" name="name[]" class="w-full px-4 py-2 border rounded" required>
                        </div>
                        <div>
                            <label for="addDescription" class="block text-sm font-medium">Description</label>
                            <textarea id="addDescription" name="description[]" class="w-full px-4 py-2 border rounded" required></textarea>
                        </div>
                        <div>
                            <label for="addImgUrl" class="block text-sm font-medium">Image URL</label>
                            <input type="url" id="addImgUrl" name="imgUrl[]" class="w-full px-4 py-2 border rounded" required>
                        </div>
    
    `;
    categoriesInputContainer.appendChild(newCategoryDiv);
});