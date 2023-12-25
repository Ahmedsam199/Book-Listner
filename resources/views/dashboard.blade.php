<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <ul class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="bookList">
                    <!-- Placeholder for book list items -->
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the element where you want to display the book names
            const bookListElement = document.getElementById('bookList');

            // Check if the element exists before making the API call
            if (bookListElement) {
                axios.get('http://127.0.0.1:8000/api/books')
                    .then(function (response) {
                        const books = response.data;
                        const template = document.createElement('template');
                        template.innerHTML = `
                            <li class="bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden shadow-md">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200" data-bookname></h3>
                                    <div class="flex justify-between mt-2">
                                        <span class="text-sm text-gray-500 dark:text-gray-300" data-id></span>
                                        <span class="text-sm text-gray-500 dark:text-gray-300" data-pagenumber></span>
                                        <span class="text-sm text-gray-500 dark:text-gray-300" data-createdat></span>
                                         <button class="bg-blue-500 text-white px-2 py-1 rounded" data-id-btnDelete>Delete Book</button>
                              
                                        <button class="bg-blue-500 text-white px-2 py-1 rounded" data-id-btn>View Details</button>
                                    </div>
                                </div>
                            </li>
                        `;

                        // Loop through the books and append the information to the list
                        books.forEach(function (book) {
                            const clone = document.importNode(template.content, true);

                            clone.querySelector('[data-bookname]').textContent = book.Bookname;
                            clone.querySelector('[data-id]').textContent = `ID: ${book.id}`;
                            clone.querySelector('[data-pagenumber]').textContent = `Pages: ${book.PageNumber}`;
                            clone.querySelector('[data-createdat]').textContent = `Created At: ${book.created_at}`;

                            const buttonDelete = clone.querySelector('[data-id-btnDelete]');
                            buttonDelete.addEventListener('click', function () {
axios.delete(`http://localhost:8000/api/books/${book.id}`).then((response)=>{
 window.location.href = '/';  

})
                            });

                            const button = clone.querySelector('[data-id-btn]');
                            button.addEventListener('click', function () {
                                // Navigate to another page with the book's ID
                                window.location.href = `/detailsPage?id=${book.id}`;
                            });

                            bookListElement.appendChild(clone);
                        });
                    })
                    .catch(function (error) {
                        console.error('Error fetching books:', error);
                    });
            } else {
                console.error('Element with ID "bookList" not found.');
            }
        });
    </script>
</x-app-layout>
