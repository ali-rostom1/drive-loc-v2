categoriesContainer = document.querySelector(".categories-container");
cardsContainer = document.querySelector(".card-container");





function categoriesAJAX(callback){
    for(el of categoriesContainer.children){
        el.addEventListener("click",function(){
            let id = this.id;
            if(this.id == 0){
                location.reload();
                
            }
            const xhr = new XMLHttpRequest();
            xhr.open("GET","AJAX/getVehicle.php?id_cat="+id,true);
            xhr.onload = () =>{
                if(xhr.status === 200){
                    console.log(JSON.parse(xhr.responseText));
                    displayCategoryVehicles(JSON.parse(xhr.responseText));
                }else{
                    console.log("error");
                }
            }
            xhr.send();
            for(ele of categoriesContainer.children){
                ele.classList.remove("active");
            }
            this.classList.toggle("active");
            pagination.classList.add("hidden");
        })
    }
    callback();
}
function checkSessionStorage(){
    if(window.sessionStorage.getItem("id_cat")){
        id = window.sessionStorage.getItem("id_cat");
        for(el of categoriesContainer.children){
            if(el.id == id){
                el.click();
                window.sessionStorage.clear();
            }
        }
    }
}


function displayCategoryVehicles(data){
    cardsContainer.innerHTML = "";
    data.forEach(element => {
        let div = document.createElement("div");
        div.classList = "p-3 w-full md:w-6/12 lg:w-4/12";
        div.id = element.id_cat;
        div.innerHTML=`
                            <div class="bg-white border shadow-md text-gray-500"> 
                                <a href="#"><img src="${element["img_path"]}" class="hover:opacity-90 w-full" alt="..." width="600" height="450"/></a>
                                <div class="p-6">
                                    <h4 class="font-bold mb-2 text-gray-900 text-xl"><a href="#" class="hover:text-gray-500">${element["model_vehicle"]}</a></h4>
                                    <hr class="border-gray-200 my-4">
                                    <div class="flex items-center justify-between">
                                        <div class="inline-flex items-center py-1 space-x-1">
                                            <span>4.7</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1.125em" height="1.125em" class="text-primary-500">
                                                <g>
                                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                                    <path d="M12 18.26l-7.053 3.948 1.575-7.928L.587 8.792l8.027-.952L12 .5l3.386 7.34 8.027.952-5.935 5.488 1.575 7.928z"></path>
                                                </g>
                                            </svg>
                                            <span>(245 reviews)</span>
                                        </div>
                                        <p class="font-bold text-gray-900">$${element["price"]}/day</p>
                                    </div>
                                </div>                                 
                            </div>                             
        `;
        cardsContainer.appendChild(div);
    });
}

categoriesAJAX(checkSessionStorage);


document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('productModal');
    const closeModal = document.getElementById('closeModal');
    const productContent = document.getElementById('productContent');

    for(card of cardsContainer.children){
        card.addEventListener('click', async function(){
            const productId = this.id;
            console.log(productId);
            const response = await fetch(`AJAX/getVehicle.php?id_vehicle=${productId}`);
            const data = await response.json();
            console.log(data);
            productImage.src = data[0].imgUrl;
            productName.innerHTML=data[0].model;
            productLocation.innerHTML=data[0].location;
            productDescription.innerHTML=data[0].description;
            productPrice.innerHTML="$" + data[0].price;

            if(!data[1].isReserved) productRating.classList.add("hidden");
            else if(data[1].isDeleted) productRating.classList.add("hidden");
            else productRating.classList.remove("hidden");
            
            reserve.onclick = function(){
                reserveModal.classList.toggle("hidden");
                document.getElementById('reserveForm').addEventListener('submit', function(event) {
                    event.preventDefault();
            
                    const formData = new FormData(this);

                    fetch('AJAX/reserve.php?id_vehicle='+productId, {
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
            }
            colorRatingStars(data[1].value);


            stars= productRating.children;
            for(let i=0;i<stars.length;i++){
                stars[i].addEventListener("click",async function(){
                   await fetch(`AJAX/sendRating.php?value=${i+1}&id_vehicle=${productId}`);
                   for(j=0;j<stars.length;j++){
                        if(j<=i){
                            stars[j].classList.add("text-yellow-300");
                        }else{
                            stars[j].classList.remove("text-yellow-300");
                        }
                   }
                });
            }
            modal.classList.remove('hidden');
        });
    };

    // Close modal
    closeModal.addEventListener('click', () => {
        modal.classList.add('hidden');
        array = productRating.children;
        for (let i = 0; i < array.length; i++) {
            array[i].classList.remove("text-yellow-300");
        }
    });
});


function colorRatingStars(value){
    if(value==0) return;
    array = productRating.children;
    for (let i = 0; i < value; i++) {
        array[i].classList.add("text-yellow-300");
    }
}

stars = document.querySelectorAll("#productRating svg");
for(let i=0;i<stars.length;i++){
    stars[i].addEventListener("mouseover",function(){
        for(let j=0;j<stars.length;j++)
        if(j<=i){
            stars[j].classList.add("text-yellow-300");
        }else{
            stars[j].classList.remove("text-yellow-300");
        }
    });
}

cancel.onclick = function(){
    reserveModal.classList.toggle("hidden");
}