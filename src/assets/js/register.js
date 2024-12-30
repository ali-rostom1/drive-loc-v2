let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
let passRegex =  /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,32}$/;
let nameRegex =/^[a-zA-Z\s'-]{2,50}$/;

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

function dynamicPasswordConfirmValidation(){
    document.querySelector("#confirmPassword").addEventListener("input",function(){
        if(this.value===passwordInput.value){
            this.classList.remove('border-red-500');
            this.classList.add('border-green-500');
            if(!this.parentNode.lastElementChild.classList.contains("hidden")){
                this.parentNode.lastElementChild.classList.toggle("hidden");
            }
        }else{
            this.classList.add('border-red-500');
            this.classList.remove('border-green-500');
            if(this.parentNode.lastElementChild.classList.contains("hidden")){
                this.parentNode.lastElementChild.classList.toggle("hidden");
            }
        }
        
    })
}
function inputValidation(input,regex){
    return regex.test(input.value);
}
function passwordConfirmInputValidation(){
    return document.querySelector("#confirmPassword").value === password.value ? true : false;
}

dynamicInputValidation(nameInput,nameRegex);
dynamicInputValidation(emailInput,emailRegex);
dynamicInputValidation(passwordInput,passRegex);
dynamicPasswordConfirmValidation();


document.querySelector("form").addEventListener("submit",function(event){
    event.preventDefault();

    if(inputValidation(emailInput,emailRegex) && inputValidation(passwordInput,passRegex) && inputValidation(nameInput,nameRegex) && passwordConfirmInputValidation()){
        document.querySelector("form").submit();
    }
})