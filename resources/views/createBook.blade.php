<x-app-layout>
     <style>
        #bookForm {
            width: 400px;
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            
        }
        input{
            background-color: #4a5568 !important
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .block {
            display: block;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-gray-700 {
            color: #4a5568;
        }

        .dark:text-gray-300 {
            color: #CBD5E0;
        }

        .form-input {
            appearance: none;
            background-color: #edf2f7;
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
            border-radius: 0.25rem;
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: #4299e1;
        }

        .bg-blue-500 {
            background-color: #4299e1;
        }

        .bg-blue-700:hover {
            background-color: #2b6cb0;
        }

        .text-white {
            color: #fff;
        }

        .font-bold {
            font-weight: 700;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .rounded {
            border-radius: 0.375rem;
        }

        button {
            cursor: pointer;
        }
    </style>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <center>
                        Enter Your New Book
                    </center>
                </div>
                <div>
                    <center>
                      <form id="bookForm" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="Bookname" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Book Name</label>
            <input name="Bookname" id="Bookname" class="form-input mt-1 block w-full" type="text">
        </div>
        <div class="mb-4">
            <label for="PageNumber" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Page Number</label>
            <input name="PageNumber" id="PageNumber" class="form-input mt-1 block w-full" type="number">
        </div>
        <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Path</label>
            <input name="file" id="file" class="form-input mt-1 block w-full" type="file">
        </div>

        <button type="button" onclick="submitForm()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
    </form>
    </center>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function submitForm() {
        // Get form data
        const formData = new FormData(document.getElementById('bookForm'));

        // Use Axios to send a POST request
        axios.post('http://127.0.0.1:8000/api/books', formData)
            .then(response => {
                // Handle success, e.g., show a success message
 window.location.href = '/';            })
            .catch(error => {
                // Handle error, e.g., show an error message
                console.error(error);
            });
    }
</script>
