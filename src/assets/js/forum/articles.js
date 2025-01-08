
function openModal() {
    modal.classList.remove('hidden');
}

function closeModal() {
    modal.classList.add('hidden');
}


modal.addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.querySelectorAll("article").forEach(article => {
    article.addEventListener("click",async function(){
        openModal();
        let id = parseInt(this.getAttribute("data-id"));
        const response = await fetch("AJAX/article.php?get&id_article="+id,true);
        const data = await response.json();
        console.log(data);
    });
});