function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `anime-toast anime-toast--${type}`;
    toast.innerText = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function addToWatchlist(animeId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/api/watchlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `anime_id=${animeId}&_csrf=${csrfToken}`
    })
    .then(response => {
        // If the backend forces a redirect (e.g. to /login because unauthenticated)
        if (response.redirected) {
            window.location.href = response.url; 
            return;
        }
        return response.json();
    })
    .then(data => {
        if (data && data.success) {
            showToast('Added to watchlist!', 'success');
        } else if (data && data.error) {
            showToast(data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Failed to connect to server.', 'error');
    });
}

function removeFromWatchlist(animeId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/api/watchlist/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `anime_id=${animeId}&_csrf=${csrfToken}`
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        return response.json();
    })
    .then(data => {
        if (data && data.success) {
            showToast('Removed from watchlist.', 'success');
            // Remove the card from the DOM instantly
            const card = document.getElementById(`anime-card-${animeId}`);
            if (card) {
                card.remove();
            }
        } else if (data && data.error) {
            showToast(data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Failed to connect to server.', 'error');
    });
}
