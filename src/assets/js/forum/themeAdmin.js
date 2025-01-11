
const closeAddModal = document.getElementById("closeAddModal");
const addModal = document.getElementById("addModal");


closeAddModal.addEventListener("click", function () {
    addModal.classList.add("hidden");
});

addForm = document.getElementById("addForm");


addForm.addEventListener("submit",function(e){
    e.preventDefault();
    const formData = new FormData(this);

    fetch("../../clientPages/AJAX/forum/theme.php?add",{
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


editBtns = document.querySelectorAll(".edit");
deleteBtns = document.querySelectorAll(".delete");

for(editBtn of editBtns){
    editBtn.addEventListener("click",async function(){
        editModal.classList.remove('hidden');
        const id = this.parentNode.parentNode.getAttribute("data-id");
        const response = await fetch("../../clientPages/AJAX/forum/theme.php?get&id_theme="+id);
        const data = await response.json();
        if(data){
            editName.value = data.name;
            editDescription.value = data.description;
            editForm.addEventListener("submit",function(e){
                e.preventDefault();
                const formData = new FormData(this);
            
                fetch("../../clientPages/AJAX/forum/theme.php?edit&id_theme="+id,{
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
        if(confirm("Are you sure you want to delete theme id: "+id)){
            const response = await fetch("../../clientPages/AJAX/forum/theme.php?delete&id_theme="+id);
            const data = await response.json();
            if(data.success){
                this.parentNode.parentNode.remove();
            }
        }
    })
}



closeEditModal.onclick = function(){
    editModal.classList.toggle("hidden");
}