<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JSON Response Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #data {
            margin-top: 10px;
            border-collapse: collapse;
            width: 100%;
        }
        table {
            border: 1px solid #ddd;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>JSON Response Example</h1>

    <p>This page demonstrates how to make a single-page web client request using AJAX to retrieve and display JSON data.</p>

    <h2>Response Data</h2>
    <table id="data">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Location</th> 
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'http://localhost:8019/',
                type: 'GET',
                success: function(response) {
                    $('#data tbody').empty();

                    response.data.forEach(function(item) {
                        $('#data tbody').append(`
                            <tr>
                                <td>${item.name}</td>
                                <td>${item.age}</td>
                                <td>${item.email}</td>
                                <td>${item.location}</td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.log("Error occurred: " + error);
                }
            });
        });
    </script>

</body>
</html>
