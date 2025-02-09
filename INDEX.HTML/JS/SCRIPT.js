let users = {};

document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let name = document.getElementById('name').value;
    let phone = document.getElementById('phone').value;
    let birthdate = document.getElementById('birthdate').value;
    let gender = document.getElementById('gender').value;
    let address = document.getElementById('address').value;
    
    if (users[email]) {
        alert('Account already exists! Please login.');
    } else {
        users[email] = { name, password, phone, birthdate, gender, address };
        alert('Registration Successful! Please login.');
        showLogin();
    }
});

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    let email = document.getElementById('loginEmail').value;
    let password = document.getElementById('loginPassword').value;
    
    if (users[email] && users[email].password === password) {
        alert('Login Successful! Welcome, ' + users[email].name);
    } else {
        alert('Invalid email or password!');
    }
});

function showLogin() {
    document.getElementById('registerContainer').style.display = 'none';
    document.getElementById('loginContainer').style.display = 'block';
}

function showRegister() {
    document.getElementById('registerContainer').style.display = 'block';
    document.getElementById('loginContainer').style.display = 'none';
}