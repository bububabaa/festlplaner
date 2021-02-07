<!DOCTYPE html>
<html lang="en">
    <style>
        body {
    font-family: sans-serif;
    background-color: #111d4a;
}

* {
    box-sizing: border-box;
}
h1 {
    color: #eee;
    margin-bottom: 30px;
}
.container {
    padding: 40px;
    margin: 0 auto;
    max-width: 1000px;
    text-align: center;
}

#charactersList {
    padding-inline-start: 0;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    grid-gap: 20px;
}

.character {
    list-style-type: none;
    background-color: #eaeaea;
    border-radius: 3px;
    padding: 10px 20px;
    display: grid;
    grid-template-columns: 3fr 1fr;
    grid-template-areas:
        'name image'
        'house image';
    text-align: left;
}

.character > h2 {
    grid-area: name;
    margin-bottom: 0px;
}

.character > p {
    grid-area: house;
    margin: 0;
    margin-top: -18px;
}

.character > img {
    max-height: 100px;
    grid-area: image;
}

#searchBar {
    width: 100%;
    height: 32px;
    border-radius: 3px;
    border: 1px solid #eaeaea;
    padding: 5px 10px;
    font-size: 12px;
}

#searchWrapper {
    position: relative;
}

#searchWrapper::after {
    content: '🔍';
    position: absolute;
    top: 7px;
    right: 15px;
}

    </style>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Document</title>
        <link rel="stylesheet" href="app.css" />
    </head>
    <body>
        <div class="container">
            <h1>&#x2728;Harry Potter Characters &#x2728;</h1>
            <div id="searchWrapper">
                <input
                    type="text"
                    name="searchBar"
                    id="searchBar"
                    placeholder="search for a character"
                />
            </div>
            <ul id="charactersList"></ul>
        </div>
        <script src="app.js"></script>
        <script>
        const charactersList = document.getElementById('charactersList');
const searchBar = document.getElementById('searchBar');
let hpCharacters = [];

searchBar.addEventListener('keyup', (e) => {
    const searchString = e.target.value.toLowerCase();

    const filteredCharacters = hpCharacters.filter((character) => {
        return (
            character.name.toLowerCase().includes(searchString) ||
            character.house.toLowerCase().includes(searchString)
        );
    });
    displayCharacters(filteredCharacters);
});

const loadCharacters = async () => {
    try {
        const res = await fetch('https://hp-api.herokuapp.com/api/characters');
        hpCharacters = await res.json();
        displayCharacters(hpCharacters);
    } catch (err) {
        console.error(err);
    }
};

const displayCharacters = (characters) => {
    const htmlString = characters
        .map((character) => {
            return `
            <li class="character">
                <h2>${character.name}</h2>
                <p>House: ${character.house}</p>
                <img src="${character.image}"></img>
            </li>
        `;
        })
        .join('');
    charactersList.innerHTML = htmlString;
};

loadCharacters();

        </script>
    </body>
</html>
