const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box"),
    chatWrapper = document.querySelector(".chat-wrapper");
var result = {};
form.onsubmit = (e) => {
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/chat/insert-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
        getChat();
    }
    // chatWrapper.onmouseenter = () => {
    //     chatWrapper.classList.add("active");
    // }

// chatWrapper.onmouseleave = () => {
//     chatWrapper.classList.remove("active");
// }

$(document).ready(function() {
    chatWrapper.classList.add("active");
})

setInterval(() => {
    getChat();
}, 3000);
getChat();
scrollToBottom();


function getChat() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/chat/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (chatWrapper.classList.contains("active")) {
                    scrollToBottom();
                    chatWrapper.classList.remove("active");
                }
            }
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + incoming_id);
}

function getChatAPI() {
    $.ajax({
        URL: "../php/chat/get-chat.php",
        METHOD: "POST",
        DATA: { incoming_id },
        SUCCESS: function(result) {
            $.each(result, function(key, value) {
                if (value.id == "incoming")
                    window.result[value.id] = [value.message, value.profile];
                else
                    window.result[value.id] = value.message;

            });
        },
        COMPLETE: function() {
            console.log(result);
        }
    });
}

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}