// Newsletter subscription functionality
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('newsletter-form');
    const emailInput = document.getElementById('newsletter-email');
    const submitButton = document.getElementById('newsletter-submit');
    const messageDiv = document.getElementById('newsletter-message');
    
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = emailInput.value.trim();
        
        if (!email) {
            showMessage('Por favor, introduce tu email', 'error');
            return;
        }
        
        if (!isValidEmail(email)) {
            showMessage('Por favor, introduce un email válido', 'error');
            return;
        }
        
        // Disable form during submission
        submitButton.disabled = true;
        submitButton.textContent = 'Suscribiendo...';
        
        // Prepare form data
        const formData = new FormData();
        formData.append('action', 'newsletter_subscribe');
        formData.append('email', email);
        formData.append('nonce', newsletter_ajax.nonce);
        
        // Send AJAX request
        fetch(newsletter_ajax.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showMessage(data.data, 'success');
                emailInput.value = '';
            } else {
                showMessage(data.data, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('Error de conexión. Inténtalo de nuevo.', 'error');
        })
        .finally(() => {
            // Re-enable form
            submitButton.disabled = false;
            submitButton.textContent = 'Suscribirse';
        });
    });
    
    function showMessage(message, type) {
        messageDiv.textContent = message;
        messageDiv.className = `mt-4 text-sm ${type === 'success' ? 'text-green-400' : 'text-red-400'}`;
        messageDiv.style.display = 'block';
        
        // Hide message after 5 seconds
        setTimeout(() => {
            messageDiv.style.display = 'none';
        }, 5000);
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});