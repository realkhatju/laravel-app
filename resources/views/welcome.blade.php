<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accessories</title>
    <style>
        /* Basic CSS for styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            /* Responsive columns */
            grid-gap: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            /* Ensure image doesn't overflow */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card img {
            width: 100%;
            height: 200px;
            /* Fixed height for consistent image size */
            object-fit: cover;
            /* Maintain aspect ratio and cover the container */
            display: block;
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-description {
            color: #666;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="container">
        <h1>Accessories</h1>
        <div id="accessories-list" class="grid">
        </div>
        <button id="apiButton" class="button">Load Accessories</button>
    </div>
    <script>
        document.getElementById('apiButton').addEventListener('click', function() {
            const url = new URL('https://ecommerceapp.arfilifestyle.com/api/accessories');
            fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const accessoriesList = document.getElementById('accessories-list');
                    accessoriesList.innerHTML = ''; // Clear previous results

                    data.accessories.forEach(accessory => {
                        const card = document.createElement('div');
                        card.className = 'card';

                        // Safe substring handling:
                        let descriptionText = accessory.description;
                        if (descriptionText === null || descriptionText === undefined) {
                            descriptionText =
                            ""; // Or some other default value like "No description available"
                        } else if (descriptionText.length > 100) {
                            descriptionText = descriptionText.substring(0, 100) + "...";
                        }

                        card.innerHTML = `
                        <img src="${accessory.mainPhotoURL}" alt="${accessory.item_name}">
                        <div class="card-content">
                            <h2 class="card-title">${accessory.item_name}</h2>
                            <p class="card-description">${descriptionText}</p>
                        </div>
                    `;

                        accessoriesList.appendChild(card);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred.');
                });
        });
    </script>
</body>

</html>
