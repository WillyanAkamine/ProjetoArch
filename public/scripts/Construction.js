const URL = 'http://localhost/api'; // URL do seu backend

// Função para salvar uma nova obra ou editar uma existente
const saveConstruction = async (formData) => {
    const constructionId = formData.get('construction_id');
    const method = constructionId ? 'PUT' : 'POST';
    const url = constructionId ? `${URL}/obra/${constructionId}` : `${URL}/obra`;

    fetch(url, {
        method: method,
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        window.location.reload(); // Recarrega a página após salvar
    })
    .catch(error => console.error('Erro:', error));
};

// Função para deletar um documento
const deleteDocument = async (documentId) => {
    if (confirm('Você tem certeza que deseja deletar este documento?')) {
        fetch(`${URL}/documento/${documentId}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            window.location.reload(); // Recarrega a página após deletar
        })
        .catch(error => console.error('Erro ao deletar o documento:', error));
    }
};

// Função para mostrar o formulário ao clicar no botão "Adicionar Nova Obra"
document.getElementById('add-construction-btn').addEventListener('click', function() {
    const form = document.getElementById('construction-form');
    form.style.display = 'block';  // Exibe o formulário
    document.getElementById('construction_id').value = ''; // Limpa o campo de ID
    document.getElementById('name').value = '';  // Limpa o nome
    document.getElementById('description').value = '';  // Limpa a descrição
});

// Envia o formulário para salvar a obra
document.getElementById('construction-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    await saveConstruction(formData);
});

// Deletar documento
window.deleteDocument = deleteDocument;  // Disponibiliza deleteDocument globalmente
