editButtons = document.querySelectorAll(".edit");
deleteButtons = document.querySelectorAll(".delete");

for(editBtn of editButtons){
    editBtn.addEventListener("click",async function(){
        id = this.parentElement.parentElement.id;
        reserveModal.classList.toggle("hidden");
        document.getElementById('reserveForm').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const formData = new FormData(this);

            fetch('AJAX/reserve.php?id_res='+id, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location = "reservations.php";
                }
            })
        });

    })
}

for(delBtn of deleteButtons){
    delBtn.addEventListener("click",async function(){
        id = this.parentElement.parentElement.id;
        await fetch(`AJAX/reserve.php?del&id_res=${id}`);
        this.parentElement.parentElement.remove();
    })
}