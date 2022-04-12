let addMessage = document.querySelector('#addMessage');
if(addMessage) {
    addMessage.addEventListener('click', ()=>{
        const xhr = new XMLHttpRequest();
        xhr.responseType = 'json';

        //Retrieves message content
        const messageContent = {
            content : document.getElementById('tchatMessage').value
        };

        xhr.open('post', '/api/add-message.php');

        xhr.onload = function() {

            if (xhr.status === 404) {
                alert("Une erreur s'est produite");
                return;
            } else if (xhr.status === 400) {
                alert('Un paramètre est manquant');
                return;
            }

            const response = xhr.response;
            console.log(response.content);
            console.log(response.dateTime);
            console.log(response.user);

        }

        xhr.send(JSON.stringify(messageContent));
    });
}