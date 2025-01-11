rows = document.querySelectorAll("tbody tr");

for(row of rows){
    console.log(row)
}


approveBtns = document.querySelectorAll(".approve");

for(approveBtn of approveBtns){
    approveBtn.onclick = async function(){
        const id = this.parentNode.parentNode.getAttribute("data-id");
        const repsonse = await fetch("../../clientPages/AJAX/forum/article.php?approve&id_article="+id);
        const data = await repsonse.json();
        if(data.success){
            window.location.reload();
        }
    }
}
disapproveBtns = document.querySelectorAll(".disapprove");

for(disapproveBtn of disapproveBtns){
    disapproveBtn.onclick = async function(){
        const id = this.parentNode.parentNode.getAttribute("data-id");
        const repsonse = await fetch("../../clientPages/AJAX/forum/article.php?disapprove&id_article="+id);
        const data = await repsonse.json();
        if(data.success){
            window.location.reload();
        }
    }
}