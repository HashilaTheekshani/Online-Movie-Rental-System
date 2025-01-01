document.addEventListener('DOMContentLoaded', loadMovies);

function loadMovies() {
    fetch('movies.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, 'text/xml');
            const movies = xmlDoc.getElementsByTagName('movie');
            const movieList = document.getElementById('movieList');

            for (let i = 0; i < movies.length; i++) {
                const movieDiv = document.createElement('div');
                movieDiv.classList.add('movie-container'); // Add CSS class for styling
            
                movieDiv.innerHTML = `
                    <h3>${movies[i].getElementsByTagName('title')[0].textContent}</h3>
                    <p>Genre: ${movies[i].getElementsByTagName('genre')[0].textContent}</p>
                    <p>Release Year: ${movies[i].getElementsByTagName('release_year')[0].textContent}</p>
                    <p>Rating: ${movies[i].getElementsByTagName('rating')[0].textContent}</p>
                    <p>Available: ${movies[i].getElementsByTagName('available')[0].textContent}</p>
                    <button onclick="rentMovie(${i + 1})">Rent</button>
                    <button onclick="returnMovie(${i + 1})">Return</button>
                `;
                movieList.appendChild(movieDiv);
            }

            
        });
}

function rentMovie(movieId) {
    const loggedInUser = sessionStorage.getItem('loggedInUser');
    if (!loggedInUser) {
        alert('Please log in to rent a movie.');
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
                    const rentals = users[i].getElementsByTagName('rentals')[0];
                    const rentedMovies = rentals.textContent.split(',').filter(Boolean);
                    
                    // Check if movie is already rented
                    if (rentedMovies.includes(movieId.toString())) {
                        alert('You have already rented this movie.');
                        return;
                    }
                    
                    rentals.textContent += movieId + ',';
                    updateMovieAvailability(movieId, false);
                    saveFile('users.xml', new XMLSerializer().serializeToString(xmlDoc));
                    alert('Movie rented successfully!');
                    return;
                }
            }
        });
}

function returnMovie(movieId) {
    const loggedInUser = sessionStorage.getItem('loggedInUser');
    if (!loggedInUser) {
        alert('Please log in to return a movie.');
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
                    const rentals = users[i].getElementsByTagName('rentals')[0];
                    const rentedMovies = rentals.textContent.split(',').filter(Boolean);
                    
                    // Check if movie is not rented
                    if (!rentedMovies.includes(movieId.toString())) {
                        alert('You have not rented this movie.');
                        return;
                    }

                    // Remove movie from rentals
                    rentals.textContent = rentedMovies.filter(m => m !== movieId.toString()).join(',') + ',';
                    updateMovieAvailability(movieId, true);
                    saveFile('users.xml', new XMLSerializer().serializeToString(xmlDoc));
                    alert('Movie returned successfully!');
                    return;
                }
            }
        });
}

function updateMovieAvailability(movieId, available) {
    fetch('movies.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, 'text/xml');
            const movies = xmlDoc.getElementsByTagName('movie');

            for (let i = 0; i < movies.length; i++) {
                if (movies[i].getElementsByTagName('id')[0].textContent == movieId) {
                    movies[i].getElementsByTagName('available')[0].textContent = available;
                    saveFile('movies.xml', new XMLSerializer().serializeToString(xmlDoc));
                    return;
                }
            }
        });
}

