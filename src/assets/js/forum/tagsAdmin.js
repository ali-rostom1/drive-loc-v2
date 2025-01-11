document.getElementById('closeEditModal').addEventListener('click', function () {
    document.getElementById('editModal').classList.add('hidden');
});

document.getElementById('closeAddModal').addEventListener('click', function () {
    document.getElementById('addModal').classList.add('hidden');
});


addForm.addEventListener("submit", async function(e){
    e.preventDefault();
    const formData = new FormData(this);

    fetch("../../clientPages/AJAX/forum/tag.php?add",{
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data=>{
        if(data.success){
            window.location.reload();
        }
    })
})
document.getElementById('addMoreTags').addEventListener('click', function () {
    const tagsInputContainer = document.getElementById('tagsInputContainer');
    const newInput = document.createElement('div');
    newInput.classList.add('tag-input', 'mt-4');
    newInput.innerHTML = `
        <label class="block text-sm font-medium">Tag Name</label>
        <input type="text" name="name[]" class="w-full px-4 py-2 border rounded" required>
    `;
    tagsInputContainer.appendChild(newInput);
});


editBtns = document.querySelectorAll(".edit");
deleteBtns = document.querySelectorAll(".delete");


for(editBtn of editBtns){
    editBtn.addEventListener("click",async function(){
        editModal.classList.remove('hidden');
        const id = this.parentNode.parentNode.getAttribute("data-id");
        const response = await fetch("../../clientPages/AJAX/forum/tag.php?get&id_tag="+id);
        const data = await response.json();
        if(data){
            editName.value = data.name;
            editForm.addEventListener("submit",function(e){
                e.preventDefault();
                const formData = new FormData(this);
            
                fetch("../../clientPages/AJAX/forum/tag.php?edit&id_tag="+id,{
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data=>{
                    if(data.success){
                        window.location.reload();
                    }
                })
            });
        }
    })

}

for(deleteBtn of deleteBtns){
    deleteBtn.addEventListener("click",async function(){
        const id = this.parentNode.parentNode.getAttribute("data-id");
        if(confirm("Are you sure you want to delete tag id: "+id)){
            const response = await fetch("../../clientPages/AJAX/forum/tag.php?delete&id_tag="+id);
            const data = await response.json();
            if(data.success){
                this.parentNode.parentNode.remove();
            }
        }
    })
}