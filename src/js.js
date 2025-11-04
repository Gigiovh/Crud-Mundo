// Efeito no tituulo
document.addEventListener('DOMContentLoaded', function() {
    const title = document.querySelector('.banner-title');
    if (title) {
        const originalText = title.textContent;
        title.textContent = '';
        
        let i = 0;
        const typeWriter = () => {
            if (i < originalText.length) {
                title.textContent += originalText.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        };
        typeWriter();
    }
});

// efeito de card flutuante
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    
    cards.forEach((card, index) => {
        // Adiciona delay diferente para cada card
        card.style.animationDelay = `${index * 0.2}s`;
        
        // Efeito de hover mais suave
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
