const message = document.querySelector('.send-message');
const containerMessage = document.querySelector('.global-chat')

if (message) {
    message.addEventListener('keypress', function (event) {
        if (event.keyCode === 13) {
            fetch('/?c=globalChatApi', {
                method: 'POST',
                body: JSON.stringify({
                    content: message.value,
                })
            })
                .then(response => response.json())
                .then({

                })

            message.value = '';
        }
    })
    setInterval(function () {
        fetch('/?c=globalChat&a=get-all', {method: 'POST'})
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
            },1000)

        }
    })
}
