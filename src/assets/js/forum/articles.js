// DISPLAY ARTICLE
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
    article.addEventListener("click",renderModal);
});

async function renderModal(){
    openModal();
    
    let id = parseInt(this.getAttribute("data-id"));
    const response = await fetch("../AJAX/forum/article.php?get&id_article="+id);
    const data = await response.json();
    modal.setAttribute("data-id",id);
    displayArticleModal(data);
    commentForm.onsubmit = function(e){
        e.preventDefault(); 
        if(this.querySelector("textarea").value){
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
    }
    favoriteBtn.onclick = async function(){
        if(toggleFavorite(this)){
            const response2 = await fetch("../AJAX/forum/article.php?favorite&id_article="+id);
        }else{
            const response2 = await fetch("../AJAX/forum/article.php?unfavorite&id_article="+id);
        }
    }
}

function displayArticleModal(data){
    date = new Date(data.date);
    date = date.toDateString();
    articleTitle.innerHTML = data.title;
    displayImg.src = "data:image/png;base64," + (data.img);
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
    const svg = favoriteBtn.querySelector('svg');
    if(data.isFavorite){
        svg.classList.remove('text-gray-400');
        svg.classList.add('text-red-500');
        svg.setAttribute('fill', 'currentColor');
    }else{
        svg.classList.remove('text-red-500');
        svg.classList.add('text-gray-400');
        svg.setAttribute('fill', 'none');
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

//ADD ARTICLE 

searchTag.addEventListener("input",async function(){
    const term = searchTag.value.toLowerCase();
    searchDropdown.innerHTML = '';
    if (term.length === 0) {
        searchDropdown.classList.add('hidden');
        return;
    }
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '../AJAX/forum/tag.php?term=' + encodeURIComponent(term), true);
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            const results = JSON.parse(xhr.responseText);
            if (results.length > 0) {
                results.forEach(tag => {
                    const result = document.createElement('div');
                    result.classList = "p-2 hover:bg-gray-50 cursor-pointer";
                    result.textContent = tag.name;
                    result.id=tag.id_tag;
                    result.addEventListener('click', function(){
                        let flag = 0;
                        for (const child of selectedTags.children) {
                            if(child.textContent.includes(result.textContent)){
                                flag = 1;
                            }   
                        }
                        if(flag === 0){
                            const div = displaySelectedTag(tag);
                            selectedTags.appendChild(div);
                            
                            div.querySelector("button").onclick = ()=>{
                                div.remove();
                            }
                            searchTag.value = "";
                            searchDropdown.classList.add('hidden');
                        }
                        
                    });

                    searchDropdown.appendChild(result);
                });
                searchDropdown.classList.remove('hidden');
            } else {
                searchDropdown.classList.add('hidden');
            }
        }
    };
    xhr.send();
});

function displaySelectedTag(tag){
    let div = document.createElement("button");
    div.classList = "bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm flex items-center gap-1";
    div.id = tag.id_tag;
    div.innerHTML = `
                        ${tag.name}
                            <button type="button" class="removeTag hover:text-blue-900" >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
    `;
    return div;
}

addModal.addEventListener("submit",function(e){
    e.preventDefault();
    let ids = [];
    for(tag of selectedTags.children){
        ids.push(tag.id);
    }
    tagIds.value=ids.join(",");
    const data = new FormData(this);
    fetch('../AJAX/forum/article.php?add', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
    .then(data=>{
        if(data.success){
            document.getElementById('createPostModal').classList.add('hidden');
        }
    })
    
})

themes = document.querySelector("#themeSelect");

themes.onchange = function(){
    if(this.value){
        window.location.href = "articles.php?id_theme=" + this.value;
    }else{
        window.location.href = "articles.php";
    }
}

function toggleFavorite(button) {
    const svg = button.querySelector('svg');
    const isFavorited = svg.classList.contains('text-red-500');
    
    if (!isFavorited) {
        svg.classList.remove('text-gray-400');
        svg.classList.add('text-red-500');
        svg.setAttribute('fill', 'currentColor');
    } else {
        svg.classList.remove('text-red-500');
        svg.classList.add('text-gray-400');
        svg.setAttribute('fill', 'none');
    }
    return !isFavorited;
}
