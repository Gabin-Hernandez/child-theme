// Lucide Icons Integration
document.addEventListener('DOMContentLoaded', function() {
    // Load Lucide icons from CDN
    const script = document.createElement('script');
    script.src = 'https://unpkg.com/lucide@latest/dist/umd/lucide.js';
    script.onload = function() {
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    };
    document.head.appendChild(script);

    // Function to replace SVG icons with Lucide icons
    function replaceLucideIcons() {
        // Replace clock icons
        const clockIcons = document.querySelectorAll('[data-lucide="clock"]');
        clockIcons.forEach(icon => {
            icon.innerHTML = '<path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="10"></circle>';
        });

        // Replace shopping cart icons
        const cartIcons = document.querySelectorAll('[data-lucide="shopping-cart"]');
        cartIcons.forEach(icon => {
            icon.innerHTML = '<circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="m2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43h-15.44"></path>';
        });

        // Replace arrow right icons
        const arrowRightIcons = document.querySelectorAll('[data-lucide="arrow-right"]');
        arrowRightIcons.forEach(icon => {
            icon.innerHTML = '<path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path>';
        });

        // Replace shopping bag icons
        const bagIcons = document.querySelectorAll('[data-lucide="shopping-bag"]');
        bagIcons.forEach(icon => {
            icon.innerHTML = '<path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path>';
        });

        // Replace image icons
        const imageIcons = document.querySelectorAll('[data-lucide="image"]');
        imageIcons.forEach(icon => {
            icon.innerHTML = '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>';
        });

        // Replace tag icons
        const tagIcons = document.querySelectorAll('[data-lucide="tag"]');
        tagIcons.forEach(icon => {
            icon.innerHTML = '<path d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.586 8.586a2 2 0 0 0 2.828 0l7.172-7.172a2 2 0 0 0 0-2.828z"></path><circle cx="7.5" cy="7.5" r=".5" fill="currentColor"></circle>';
        });

        // Replace star icons
        const starIcons = document.querySelectorAll('[data-lucide="star"]');
        starIcons.forEach(icon => {
            icon.innerHTML = '<polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>';
        });

        // Replace percent icons
        const percentIcons = document.querySelectorAll('[data-lucide="percent"]');
        percentIcons.forEach(icon => {
            icon.innerHTML = '<line x1="19" x2="5" y1="5" y2="19"></line><circle cx="6.5" cy="6.5" r="2.5"></circle><circle cx="17.5" cy="17.5" r="2.5"></circle>';
        });

        // Replace fire icons
        const fireIcons = document.querySelectorAll('[data-lucide="flame"]');
        fireIcons.forEach(icon => {
            icon.innerHTML = '<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path>';
        });

        // Replace eye icons
        const eyeIcons = document.querySelectorAll('[data-lucide="eye"]');
        eyeIcons.forEach(icon => {
            icon.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle>';
        });

        // Replace heart icons
        const heartIcons = document.querySelectorAll('[data-lucide="heart"]');
        heartIcons.forEach(icon => {
            icon.innerHTML = '<path d="m19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"></path>';
        });

        // Replace x-circle icons
        const xCircleIcons = document.querySelectorAll('[data-lucide="x-circle"]');
        xCircleIcons.forEach(icon => {
            icon.innerHTML = '<circle cx="12" cy="12" r="10"></circle><path d="m15 9-6 6"></path><path d="m9 9 6 6"></path>';
        });

        // Replace search icons
        const searchIcons = document.querySelectorAll('[data-lucide="search"]');
        searchIcons.forEach(icon => {
            icon.innerHTML = '<circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.35-4.35"></path>';
        });

        // Replace chevron-left icons
        const chevronLeftIcons = document.querySelectorAll('[data-lucide="chevron-left"]');
        chevronLeftIcons.forEach(icon => {
            icon.innerHTML = '<path d="m15 18-6-6 6-6"></path>';
        });

        // Replace chevron-right icons
        const chevronRightIcons = document.querySelectorAll('[data-lucide="chevron-right"]');
        chevronRightIcons.forEach(icon => {
            icon.innerHTML = '<path d="m9 18 6-6-6-6"></path>';
        });
    }

    // Replace icons after a short delay to ensure DOM is ready
    setTimeout(replaceLucideIcons, 100);
    
    // Also replace icons when new content is loaded dynamically
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length > 0) {
                setTimeout(replaceLucideIcons, 50);
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});