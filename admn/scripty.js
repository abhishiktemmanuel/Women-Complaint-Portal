document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        // Perform client-side validation (you can add more validation as needed)
        if (username === '' || password === '') {
            alert('Both username and password are required.');
        } else {
            // If client-side validation passes, submit the form to the server for authentication
            loginForm.submit();
        }
    });
});