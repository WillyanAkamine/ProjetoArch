const URL = 'http://localhost/api';

// Função para salvar o orçamento
const saveBudget = async (formData) => {
    const user_id = formData.get('user_id');

    fetch(`${URL}/orcamento/solicitar/${user_id}`, {
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

// Manipulação do modal de adicionar item
document.getElementById('adicionarItem').addEventListener('click', function() {
    document.getElementById('modalAdicionarItem').style.display = 'block';
});

// Fechar modal
document.getElementById('fecharModal').addEventListener('click', function() {
    document.getElementById('modalAdicionarItem').style.display = 'none';
});

// Adicionar item no modal
document.getElementById('adicionarItemModal').addEventListener('click', function() {
    // Código para adicionar item na tabela
    const table = document.getElementById('orcamentoTable').getElementsByTagName('tbody')[0];
    const material = document.getElementById('material').value;
    const quantidade = document.getElementById('quantidade').value;
    const precoUnitario = 100; // Exemplo de preço unitário

    const row = table.insertRow();
    row.insertCell(0).innerHTML = 'Nome da Etapa'; // Atualize conforme necessário
    row.insertCell(1).innerHTML = material;
    row.insertCell(2).innerHTML = quantidade;
    row.insertCell(3).innerHTML = precoUnitario;
    row.insertCell(4).innerHTML = quantidade * precoUnitario;

    document.getElementById('modalAdicionarItem').style.display = 'none';
});

// Manipulação do modal de adicionar categoria
document.getElementById('adicionarCategoria').addEventListener('click', function() {
    document.getElementById('modalAdicionarCategoria').style.display = 'block';
});

document.getElementById('fecharModalCategoria').addEventListener('click', function() {
    document.getElementById('modalAdicionarCategoria').style.display = 'none';
});

document.getElementById('adicionarCategoriaModal').addEventListener('click', function() {
    const nomeCategoria = document.getElementById('nomeCategoria').value;
    const itens = document.getElementById('itens').value.split('\n');

    const categoriaDiv = document.createElement('div');
    categoriaDiv.innerHTML = `<h3>${nomeCategoria}</h3>`;
    itens.forEach(item => {
        const itemDiv = document.createElement('div');
        itemDiv.innerHTML = `<p>${item}</p>`;
        categoriaDiv.appendChild(itemDiv);
    });
    
    document.getElementById('categorias').appendChild(categoriaDiv);
    document.getElementById('modalAdicionarCategoria').style.display = 'none';
});
