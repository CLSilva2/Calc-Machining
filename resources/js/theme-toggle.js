(function() {
    const themeToggle = document.getElementById('theme-toggle');
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    const html = document.documentElement;
    const body = document.body;
    
    // Função para aplicar tema
    function applyTheme(theme) {
        if (theme === 'light') {
            html.classList.add('light-mode');
            html.style.backgroundColor = '#ffffff';
            body.style.backgroundColor = '#ffffff';
            body.style.color = '#000000';
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        } else {
            html.classList.remove('light-mode');
            html.style.backgroundColor = '#000000';
            body.style.backgroundColor = '#000000';
            body.style.color = '#ffffff';
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        }
    }
    
    // Verificar tema salvo no localStorage
    const savedTheme = localStorage.getItem('theme') || 'dark';
    applyTheme(savedTheme);
    
    // Event listener para o botão de tema
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            const isCurrentlyLight = html.classList.contains('light-mode');
            const newTheme = isCurrentlyLight ? 'dark' : 'light';
            applyTheme(newTheme);
            localStorage.setItem('theme', newTheme);
        });
    }
})();
