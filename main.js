function register() {
    const username = document.getElementById('register-username').value.trim();
    const password = document.getElementById('register-password').value.trim();

    if (!username || !password) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

    fetch('auth.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=register&nome=${username}&senha=${password}`,
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    .catch(error => console.error('Erro:', error));
}

function login() {
    const username = document.getElementById('login-username').value.trim();
    const password = document.getElementById('login-password').value.trim();

    if (!username || !password) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

    fetch('auth.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=login&nome=${username}&senha=${password}`,
    })
    .then(response => response.json())
    .then(data => alert(data.message))
    .catch(error => console.error('Erro:', error));
}

function toggleForm() {
    const loginForm = document.getElementById('login-formulario');
    const registerForm = document.getElementById('register-formulario');
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
}
