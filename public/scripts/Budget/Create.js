const URL = 'http://localhost/api';

// Função para salvar o orçamento
const saveBudget = async (formData) => {
        // Filtra apenas os materiais com quantidade > 0
    const filteredFormData = new FormData();
    for (let [key, value] of formData.entries()) {
        // Verifica se é campo de quantidade de material
        if (key.includes('[quantity]')) {
            if (parseInt(value) > 0) {
                // Adiciona o campo de quantidade
                filteredFormData.append(key, value);
                // Adiciona os campos relacionados (id e price)
                const baseKey = key.replace('[quantity]', '');
                filteredFormData.append(`${baseKey}[id]`, formData.get(`${baseKey}[id]`));
                filteredFormData.append(`${baseKey}[price]`, formData.get(`${baseKey}[price]`));
            }
        } else if (!key.startsWith('materials')) {
            // Adiciona outros campos normalmente
            filteredFormData.append(key, value);
        }
    }

    fetch(`${URL}/orcamentos/solicitar`, {
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

// Adiciona evento de submit no formulário
document.getElementById('budget-form').addEventListener('submit', async function (event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    await saveBudget(formData);
});

document.getElementById('user_id').addEventListener('change', function() {
    const clientId = this.value;
    if (!clientId) return;

    fetch(`${URL}/construcoes/cliente/${clientId}`)
        .then(response => response.json())
        .then(data => {
            // Exemplo: exibe no console ou atualiza um select de obras
            console.log(data.constructions);

            // Se quiser popular um select de obras:
            const constructionSelect = document.getElementById('construction_id');
            if (constructionSelect) {
                constructionSelect.innerHTML = '<option value="">Selecione uma obra</option>';
                data.constructions.forEach(construction => {
                    constructionSelect.innerHTML += `<option value="${construction.id}">${construction.title}</option>`;
                });
            }
        })
        .catch(error => console.log(error));
});
