function init(){
    sendTask();
}
init();

function sendTask(){
    let buttonSend = document.querySelector('#sendButton');
    buttonSend.addEventListener('click', (e) => {
        // Le formulaire doit envoyer les données à la page PHP mais sans recharger la page
        e.preventDefault();
        // On récupère les données du formulaire
        let name = document.querySelector('#task-input').value;
        let createTask = 0;
        console.log(name);
        // On envoie les données à la page PHP
        sendTaskToDB(name, createTask);
    })
}

// Function qui envoie les données à la page PHP avec une requête fetch qui contient les données a mettre dans la DB 

async function sendTaskToDB(name, createTask) {
    let response = await fetch('http://localhost:8888/DWWM/TodoList/upload_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({title: name, verified: createTask}),
    });

    // Vérifier si la requête a réussi
    if (!response.ok) {
        console.error('Erreur lors de la requête:', response.statusText);
        return;
    }

    // Avoir la réponse de la requête
    let data = await response.json();
    console.log(data);
}

