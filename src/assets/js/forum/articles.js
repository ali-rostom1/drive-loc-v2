
function openModal() {
    modal.classList.remove('hidden');
    document.body.classList.toggle("overflow-y-hidden")
}

function closeModal() {
    modal.classList.add('hidden');
    document.body.classList.toggle("overflow-y-hidden")
}


modal.addEventListener('click', function(e) {
    if(e.target === this) {
        closeModal();
    }
});

document.querySelectorAll("article").forEach(article => {
    article.addEventListener("click",async function(){
        openModal();
        
        let id = parseInt(this.getAttribute("data-id"));
        const response = await fetch("../AJAX/forum/article.php?get&id_article="+id);
        const data = await response.json();
        modal.setAttribute("data-id",id);
        displayArticleModal(data);
        console.log(data);
        commentForm.onsubmit = function(e){
            e.preventDefault(); 
            
            const data2 = new FormData(this);
            fetch("../AJAX/forum/article.php?addComment&id_article="+id,{
                method: 'POST',
                body: data2
            })
            .then(response => response.json())
            .then(data2 => {
                if(data2.success){
                    this.querySelector("textarea").value = "";
                    displayArticleModal(data);
                    closeModal();
                    
                    document.querySelector('[data-id="' + id +'"]').click();
                }

            })
        }
    });
});

function displayArticleModal(data){
    date = new Date(data.date);
    date = date.toDateString();
    articleTitle.innerHTML = data.title;
    displayImg.src = "data:image/png;base64," + data.img;
    displayDate.innerHTML = date;
    displayTotalComments.innerHTML = data["0"].length + " comments";
    displayContent.innerHTML = marked.parse(data.content);
    displayTags.innerHTML = "";
    data.tags.forEach((element)=>{
        let span = document.createElement("span");
        span.classList = "px-3 py-1 bg-gray-100 rounded-full text-sm";
        span.innerHTML = element.name;
        displayTags.appendChild(span);
    })
    if(data["0"].length >3) {
        seeMoreButton.classList.remove('hidden');
    }else seeMoreButton.classList.add('hidden');
    let range = document.createRange();
    range.setStartAfter(displayComments.children[0]);
    range.setEndBefore(seeMoreButton);
    range.deleteContents();
    data["0"].forEach((element,index)=>{
        displayComment(element);
        div = document.querySelector('[data-id="'+ element.commentId +'"]')
        if(index>2){
            div.classList.add('hidden');
        }
    })
    seeMoreButton.children[0].onclick = function(){
        this.innerHTML === "Show Less" ? this.innerHTML = "Show More" : this.innerHTML = "Show Less";
        comments = displayComments.children;
        for(let i=4;i<=data["0"].length;i++){
            comments[i].classList.toggle("hidden");
        }
    }
    
}


function displayComment(data){
    let div = document.createElement("div");
    div.classList = "space-y-6 mb-8";
    div.setAttribute("data-id",data.commentId);
    shortName = data.username.split(" ").slice(0,2).map(element =>element[0]).join("").toUpperCase();
    date = dateFns.formatDistanceToNow(new Date(data.date),{addSuffix: true})
    div.innerHTML = `
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-blue-600 font-medium">${shortName}</span>
                            </div>
                            <div class="flex-1">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-medium text-gray-900">${data.username}</span>
                                <span class="text-sm text-gray-500">${date}</span>
                            </div>
                            <p class="text-gray-700">${data.comment}</p>
                            </div>
                        </div>
                        </div>
    `;
    displayComments.insertBefore(div,seeMoreButton);
    return div;
}

