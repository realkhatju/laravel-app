<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elegant Dresses</title>
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .dress-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }
        .dress-card {
            width: calc(33% - 20px);
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            padding: 15px;
        }
        .dress-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .dress-info {
            padding-top: 10px;
        }
        .dress-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .dress-description {
            color: #666;
            margin-bottom: 10px;
            line-height: 1.5;
            height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .dress-category {
            font-size: 0.8em;
            margin-bottom: 5px;
        }
        .dress-price {
            font-weight: bold;
            margin-bottom: 5px;
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
        <h1>Elegant Dresses</h1>
        <div id="dress-list" class="dress-list">

        </div>
        <button id="apiButton" class="button">Load Dresses</button>
    </div>
    <script>
        const dressList = document.getElementById('dress-list');
        const apiButton = document.getElementById('apiButton');

        apiButton.addEventListener('click', async () => {
            try {
                const response = await fetch('http://weddingbackend.kwintechnologykw21.com:6969/api/clothes');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                dressList.innerHTML = '';

                data.data.forEach(dress => {
                    const dressCard = document.createElement('div');
                    dressCard.classList.add('dress-card');

                    const dressImage = document.createElement('img');
                    dressImage.src = dress.images.front;
                    dressImage.alt = dress.title;
                    dressImage.classList.add('dress-image');
                    dressCard.appendChild(dressImage);

                    const dressInfo = document.createElement('div');
                    dressInfo.classList.add('dress-info');

                    const dressTitle = document.createElement('h3');
                    dressTitle.textContent = dress.title;
                    dressTitle.classList.add('dress-title');
                    dressInfo.appendChild(dressTitle);

                    const dressDescription = document.createElement('p');
                    const descriptionText = dress.description || "No description available";

                    dressDescription.textContent = descriptionText.length > 100 ? descriptionText.substring(0, 100) + "..." : descriptionText;
                    dressDescription.classList.add('dress-description');
                    dressInfo.appendChild(dressDescription);

                    const dressCategory = document.createElement('p');
                    dressCategory.textContent = `Category: ${dress.category.name}`;
                    dressCategory.classList.add('dress-category');
                    dressInfo.appendChild(dressCategory);

                    const dressPrice = document.createElement('p');
                    dressPrice.textContent = `Price: ${dress.price} ${dress.currency.name}`;
                    dressPrice.classList.add('dress-price');
                    dressInfo.appendChild(dressPrice);

                    dressCard.appendChild(dressInfo);
                    dressList.appendChild(dressCard);
                });
            } catch (error) {
                console.error('Error fetching data:', error);
                alert('An error occurred while fetching data.');
            }
        });
    </script>
</body>
</html>
