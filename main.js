// Função para tentar logar
async function login() {
    console.log("Tentando logar...");
    try {
        const response = await fetch('auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'login' // Exemplo de parâmetro enviado ao backend
            })
        });

        const data = await response.json();

        if (data.erro) {
            console.error("Erro:", data.erro);
            alert(`Erro ao logar: ${data.erro}`);
        } else if (data.sucesso) {
            console.log("Sucesso:", data.sucesso);
            alert(`Login realizado: ${data.sucesso}`);
        } else {
            console.error("Erro: Resposta inesperada do servidor.");
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao se conectar ao servidor.");
    }
}

// Função para tentar registrar
async function register() {
    console.log("Tentando registrar...");
    try {
        const response = await fetch('auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'register' // Exemplo de parâmetro enviado ao backend
            })
        });

        const data = await response.json();

        if (data.erro) {
            console.error("Erro:", data.erro);
            alert(`Erro ao registrar: ${data.erro}`);
        } else if (data.sucesso) {
            console.log("Sucesso:", data.sucesso);
            alert(`Registro realizado: ${data.sucesso}`);
        } else {
            console.error("Erro: Resposta inesperada do servidor.");
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao se conectar ao servidor.");
    }
}

// Event listeners (exemplo de como associar as funções a botões)
document.getElementById('loginBtn').addEventListener('click', login);
document.getElementById('registerBtn').addEventListener('click', register);
