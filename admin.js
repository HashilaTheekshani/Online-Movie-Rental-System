window.onload = function () {
    fetch('movies.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xml = parser.parseFromString(data, 'application/xml');
            const movies = xml.getElementsByTagName('movie');
            const movieList = document.getElementById('movieList');

            for (let i = 0; i < movies.length; i++) {
                const movie = movies[i];
                const id = movie.getAttribute('id');
                const title = movie.getElementsByTagName('title')[0].textContent;
                const li = document.createElement('li');

                li.innerHTML = `${title} 
                    <a href="edit_movie.php?id=${id}">Edit</a> | 
                    <a href="delete_movie.php?id=${id}">Delete</a>`;

                movieList.appendChild(li);
            }
        });
};
