var checkbox = document.getElementById("checkbox")
var passwords = document.getElementsByClassName("password")

function changePasswordType(type){
    for(let password of passwords){
        password.type = type
    }
}

checkbox.addEventListener("change", (event) => {
    event.preventDefault()

    if(checkbox.checked){
        changePasswordType("text")
    }else{
        changePasswordType("password")
    }
})