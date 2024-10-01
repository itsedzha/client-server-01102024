<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Response Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Include Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4 text-center">JSON Response Example</h1>

        <p class="text-center mb-6">This page demonstrates how to make a single-page web client request using AJAX to retrieve and display JSON data.</p>

        <!-- Button to trigger AJAX request -->
        <div class="flex justify-center mb-4">
            <button id="loadData" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Load Data
            </button>
        </div>

        <!-- Table for displaying data -->
        <div class="overflow-x-auto">
            <table id="data" class="min-w-full table-auto bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Age</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Location</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light"></tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // When the button is clicked, trigger the AJAX request
            $('#loadData').click(function() {
                $.ajax({
                    url: 'http://localhost:8002/', // URL to your server
                    type: 'GET', // Method type
                    success: function(response) {
                        // Clear previous table rows
                        $('#data tbody').empty();

                        // Loop through the response data and append rows
                        response.data.forEach(function(item) {
                            $('#data tbody').append(`
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">${item.name}</td>
                                    <td class="py-3 px-6 text-left">${item.age}</td>
                                    <td class="py-3 px-6 text-left">${item.email}</td>
                                    <td class="py-3 px-6 text-left">${item.location}</td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log("Error occurred: " + error);
                    }
                });
            });
        });
    </script>

</body>
</html>
