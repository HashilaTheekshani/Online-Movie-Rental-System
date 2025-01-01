document.addEventListener('DOMContentLoaded', loadRentalHistory);

function loadRentalHistory() {
    const loggedInUser = sessionStorage.getItem('loggedInUser');
    if (!loggedInUser) {
        alert('Please log in to view your rental history.');
        return;
    }

    fetch('users.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, 'text/xml');
            const users = xmlDoc.getElementsByTagName('user');

            for (let i = 0; i < users.length; i++) {
                if (users[i].getElementsByTagName('username')[0].textContent === loggedInUser) {
                    const rentals = users[i].getElementsByTagName('rentals')[0].textContent.split(',');
                    displayRentalHistory(rentals);
                    return;
                }
            }
        });
}

function displayRentalHistory(rentals) {
    const historyDiv = document.getElementById('rentalHistory');
    rentals.forEach(movieId => {
        if (movieId) {
            const movieDiv = document.createElement('div');
            movieDiv.textContent = `Rented Movie ID: ${movieId}`;
            historyDiv.appendChild(movieDiv);
        }
    });
}
