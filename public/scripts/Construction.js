const URL = 'http://localhost/api';

const saveConstruction = async(formData) => {
    fetch(`${URL}/obra`, {
      method: 'POST',
      body: formData
    })
      .then(response => console.log(response))
      .catch(response => console.log(response))
  }
  
  document.getElementById('construction-form').addEventListener('submit', async function(event) {
    event.preventDefault();
  
    const form = event.target;
    const formData = new FormData(form);
  
    await saveConstruction(formData);
  });