for(category of categories.children){
    category.addEventListener("click",function(){
        window.sessionStorage.setItem("id_cat",this.id);
        window.location.href = "../../pages/clientPages/vehicles.php";

    });
}