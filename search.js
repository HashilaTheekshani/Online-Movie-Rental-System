document.getElementById('searchForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const searchTerm = document.getElementById('searchTerm').value.toLowerCase();

    fetch('movies.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(data, 'text/xml');
            const movies = xmlDoc.getElementsByTagName('movie');
            const movieList = document.getElementById('movieList');
            movieList.innerHTML = ''; // Clear previous results

            for (let i = 0; i < movies.length; i++) {
                const title = movies[i].getElementsByTagName('title')[0].textContent.toLowerCase();
                if (title.includes(searchTerm)) {
                    const movieDiv = document.createElement('div');
                    movieDiv.innerHTML = `
                        <h3>${movies[i].getElementsByTagName('title')[0].textContent}</h3>
                        <p>Genre: ${movies[i].getElementsByTagName('genre')[0].textContent}</p>
                        <p>Release Year: ${movies[i].getElementsByTagName('release_year')[0].textContent}</p>
                        <p>Rating: ${movies[i].getElementsByTagName('rating')[0].textContent}</p>
                        <p>Available: ${movies[i].getElementsByTagName('available')[0].textContent}</p>
                    `;
                    movieList.appendChild(movieDiv);
                }
            }
        });
});
