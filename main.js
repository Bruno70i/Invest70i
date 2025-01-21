async function login() {
    console.log("Tentando logar...");
    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;

    try {
        const response = await fetch('auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'login',
                nome: username,
                senha: password
            })
        });

        const data = await response.json();

        if (data.erro) {
            console.error("Erro:", data.erro);
            alert(`Erro ao logar: ${data.erro}`);
        } else if (data.sucesso) {
            console.log("Sucesso:", data.sucesso);
            alert(`Login realizado: ${data.sucesso}`);
            window.location.href = 'painel.html'; // Redirecionar para o painel
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao se conectar ao servidor.");
    }
}

async function register() {
    console.log("Tentando registrar...");
    const username = document.getElementById('register-username').value;
    const password = document.getElementById('register-password').value;

    try {
        const response = await fetch('auth.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'register',
                nome: username,
                senha: password
            })
        });

        const data = await response.json();

        if (data.erro) {
            console.error("Erro:", data.erro);
            alert(`Erro ao registrar: ${data.erro}`);
        } else if (data.sucesso) {
            console.log("Sucesso:", data.sucesso);
            alert(`Registro realizado: ${data.sucesso}`);
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        alert("Erro ao se conectar ao servidor.");
    }
}
