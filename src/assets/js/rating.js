ratings = document.querySelectorAll(".rating");


for (let i = 0; i < ratings.length; i++) {
    const stars = ratings[i];
      
    const productId = stars.id; 
    for (let j = 0; j < stars.children.length; j++) {
        stars.children[j].addEventListener("click", async function () {
            
            await fetch(`AJAX/sendRating.php?value=${j + 1}&id_vehicle=${productId}`);

           
            for (let k = 0; k < stars.children.length; k++) {
                if (k <= j) {
                    stars.children[k].classList.add("text-yellow-300"); 
                } else {
                    stars.children[k].classList.remove("text-yellow-300"); 
                }
            }
        });
    }
}

deleteButtons = document.querySelectorAll(".delete");

for (let i = 0; i < deleteButtons.length; i++) {
    const deleteButton = deleteButtons[i];
    const id = deleteButton.id;
    deleteButton.addEventListener("click",async function(){
        await fetch(`AJAX/deleteRating.php?id_vehicle=${id}`);
        deleteButton.parentElement.parentElement.remove();
    });
}