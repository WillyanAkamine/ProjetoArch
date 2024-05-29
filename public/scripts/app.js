const url = 'http://localhost/api';
const myHeaders = new Headers();
myHeaders.append("Content-Type", "application/json");

const option = {
    method: 'POST',
    headers: myHeaders
}


const saveCost = async (formData) => {
    fetch(`${url}/custo`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: formData,
        redirect: 'follow'
      })
    .then(response => console.log(response))
    .catch(response => console.log(response))
}

const form = document.getElementById('relatorio-form');

form.addEventListener('submit', async function(event) {
    event.preventDefault();

    const formData = new FormData(form);

    await saveCost(formData);
});