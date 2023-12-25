<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div id="bookDetails">
                    <!-- Placeholder for book details -->
                </div>
            </div>
        </div>
    </div>

    <style>
        #bookDetails audio {
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #bookDetails audio::-webkit-media-controls-panel {
            background-color: #2d3748; /* Background color of the audio player */
            color: #ffffff; /* Text color */
            border-radius: 8px;
        }

        #bookDetails audio::-webkit-media-controls-play-button,
        #bookDetails audio::-webkit-media-controls-volume-slider {
            display: none; /* Hide default play button and volume slider */
        }

        #bookDetails audio::-webkit-media-controls-current-time-display,
        #bookDetails audio::-webkit-media-controls-time-remaining-display {
            color: #ffffff; /* Text color for the time display */
        }

        #bookDetails audio::-webkit-media-controls-play-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4a5568; /* Play button background color */
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin: 0;
            padding: 10px
        }

        #bookDetails audio::-webkit-media-controls-play-button::before {
            content: '\25B6'; /* Unicode character for play icon */
            font-size: 24px;
            color: #ffffff; /* Play icon color */

        }

        #bookDetails h2 {
            color: #ffffff; /* Heading color */
        }

        #bookDetails p {
            color: #ffffff; /* Text color */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const bookDetailsElement = document.getElementById('bookDetails');

            if (bookDetailsElement) {
                // Extract book ID from URL parameters
                const urlParams = new URLSearchParams(window.location.search);
                const bookId = urlParams.get('id');

                if (bookId) {
                    // Fetch book details from the API
                    axios.get(`http://127.0.0.1:8000/api/books/${bookId}`)
                        .then(function (response) {
                            const bookDetails = response.data;
                            // Display the book details on the page
                            bookDetailsElement.innerHTML = `
                          <center>   <img style="border-radius: 50%;" src='https://sportshub.cbsistatic.com/i/2022/06/10/91e49e5d-41c3-4252-a649-fbf540595907/english-harry-potter-7-epub-9781781100264.jpg?auto=webp&width=1200&height=1800&crop=0.667:1,smart'
                          </center>
                            <h2>Book Details</h2>
                                <p>ID:</strong> ${bookDetails.id}</p>
                                <p>Book Name:</strong> ${bookDetails.Bookname}</p>
                                <p>Page Number:</strong> ${bookDetails.PageNumber}</p>
                                <audio controls>
  <source  src="http://localhost:8000/${bookDetails.file_path.replaceAll('public/','storage/')}" type="audio/mp3">

</audio>
                                <p>Created At:</strong> ${bookDetails.created_at}</p>
                                <p>Updated At:</strong> ${bookDetails.updated_at}</p>
                            `;
                        })
                        .catch(function (error) {
                            console.error('Error fetching book details:', error);
                            bookDetailsElement.textContent = 'Error fetching book details.';
                        });
                } else {
                    // Handle the case where the book ID is not provided
                    bookDetailsElement.textContent = 'Book ID not found in URL parameters.';
                }
            } else {
                console.error('Element with ID "bookDetails" not found.');
            }
        });
    </script>
</x-app-layout>
