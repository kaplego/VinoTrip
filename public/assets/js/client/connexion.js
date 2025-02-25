const forgotPassword = document.getElementById('forgot-password'),
    resetPassword = document.getElementById('reset-password');

forgotPassword.addEventListener('click', () => {
    resetPassword.classList.toggle('hidden');
});
