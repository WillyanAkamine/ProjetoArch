const URL = 'http://localhost/api'; // URL do seu backend

// Função para salvar um novo orçamento ou editar um existente
const saveBudget = async (formData) => {
    let budgetId = formData.get('budget_id');
    const url = budgetId ? `${URL}/orcamentos/atualizar/${budgetId}` : `${URL}/orcamentos/criar`;

    fetch(url, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.status === 201) {
            window.location.href = '/orcamentos'; // Redireciona para a lista de orçamentos após salvar
        }
    })
    .catch(error => console.error('Erro:' + error));
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

// Envia o formulário para salvar o orçamento
document.getElementById('budget-form').addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    await saveBudget(formData);
});

// Deletar documento
window.deleteDocument = deleteDocument;  // Disponibiliza deleteDocument globalmente
