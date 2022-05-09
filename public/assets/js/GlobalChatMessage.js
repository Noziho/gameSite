const message = document.querySelector('.send-message');
const containerMessage = document.querySelector('.global-chat')
const containerChat = document.querySelector('.global-chat-container');

if (message) {
    message.addEventListener('keypress', function (event) {
        if (event.keyCode === 13) {
            fetch('/?c=globalChatApi&a=message&chat=global', {
                method: 'POST',
                body: JSON.stringify({
                    content: message.value,
                }),
            })
                .then(response => {
                    if (response.status === 400) {
                        message.style.outline = "1px solid red";
                    }
                    if (response.status === 403) {
                        message.remove();
                        const muteSentence = document.createElement('p');
                        muteSentence.innerHTML = "Vous êtes mute.";
                        muteSentence.className = 'send-message';
                        containerChat.append(muteSentence);
                    }
                })
            message.style.outline = "";
            message.value = '';
        }
    })

    setInterval(function () {
        fetch('/?c=globalChat&a=get-all&chat=global', {method: 'POST'})
            .then(response => response.json())
            .then(response => {
                refreshChat(response);

            });
    }, 1000);

    function refreshChat(messages) {
        containerMessage.innerHTML = ''
        for (let i = 0; i < messages.length; i++) {
            containerMessage.innerHTML += "<div class='globalChatMessage'>" + "<p class='author'>" +
                messages[i]['author'] + " :</p>" + "<p class='message'>" + messages[i]['content'] + "</p>"
                + "<p class='time'>" + messages[i]['time'] + "</p>" + "</div>";

        }
    }

    message.addEventListener('keypress', function (event) {
        if (event.keyCode === 13) {
            containerMessage.scrollTop = containerMessage.scrollHeight;
            setTimeout(() => {
                containerMessage.scrollTop = containerMessage.scrollHeight;
            }, 1000)

        }
    })
}
