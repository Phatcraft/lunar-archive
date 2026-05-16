export function success_message(text){
    var message = document.getElementById("message")
    var submit = document.getElementById("submit")

    submit.disabled = true
    message.className = "bg-success p-2 text-white text-center"
    message.innerHTML = text + ". Đang chuyển về trang chủ ."
    
    setTimeout(() => {
        message.innerHTML = text + ". Đang chuyển về trang chủ . ."
        setTimeout(() => {
            message.innerHTML = text + ". Đang chuyển về trang chủ . . ."

            setTimeout(() => {
                location.replace("/")
            }, 1000)
        }, 1000)
    }, 1000)
}

export function failed_message(text){
    var message = document.getElementById("message")
    message.className = "bg-danger p-2 text-white text-center"
    message.innerHTML = text
}