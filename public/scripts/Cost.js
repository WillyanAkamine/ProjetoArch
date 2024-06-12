const URL = 'http://localhost/api';

const saveCost = async (formData) => {
    const client_id = formData.get('user_id');

    fetch(`${URL}/custo/${client_id}`, {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        alert(data.message)
        window.location.reload();
      })
      .catch(response => console.log(response))
  }
  
  document.getElementById('cost-form').addEventListener('submit', async function (event) {
    event.preventDefault();
  
    const form = event.target;
    const formData = new FormData(form);
  
    await saveCost(formData);
  });
