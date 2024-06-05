const url = 'http://localhost/api';

const saveCost = async (formData) => {
  fetch(`${url}/custo`, {
    method: 'POST',
    body: formData
  })
    .then(response => console.log(response))
    .catch(response => console.log(response))
}

document.getElementById('cost-form').addEventListener('submit', async function (event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);

  await saveCost(formData);
});

const saveConstruction = async(formData) => {
  fetch(`${url}/obra`, {
    method: 'POST',
    body: formData
  })
    .then(response => console.log(response))
    .catch(response => console.log(response))
}

document.getElementById('construction-form').addEventListener('submit', async function (event) {
  event.preventDefault();

  const form = event.target;
  const formData = new FormData(form);

  await saveCost(formData);
});