const URL = 'http://localhost/api';

const sendBudget = async (formData) => {
    const budget_id = formData.get('id');
    formData.delete('id');    

    fetch(`${URL}/orcamento/enviar/${budget_id}`, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.href = '/orcamentos';
        })
        .catch(response => console.log(response))
}

document.getElementById('send-budget-form').addEventListener('submit', async function (event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    await sendBudget(formData);
});