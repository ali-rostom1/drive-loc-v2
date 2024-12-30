let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
let passRegex =  /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,32}$/;


function dynamicInputValidation(input,regex){
    input.addEventListener('input',()=>{
        if(regex.test(input.value)){
            input.classList.remove('border-red-500');
            input.classList.add('border-green-500');
            if(!input.parentNode.lastElementChild.classList.contains("hidden")){
                input.parentNode.lastElementChild.classList.toggle("hidden");
            }
        }else{
            input.classList.add('border-red-500');
            input.classList.remove('border-green-500');
            if(input.parentNode.lastElementChild.classList.contains("hidden")){
                input.parentNode.lastElementChild.classList.toggle("hidden");
            }
        }
    })
}
function inputValidation(input,regex){
    return regex.test(input.value);
}

dynamicInputValidation(email,emailRegex);
dynamicInputValidation(password,passRegex);



document.querySelector("form").addEventListener("submit",function(event){
    event.preventDefault();

    if(inputValidation(email,emailRegex) && inputValidation(password,passRegex)){
        this.submit();
    }
})