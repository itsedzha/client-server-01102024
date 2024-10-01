<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Response Example</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Include Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4 text-center">JSON Response Example</h1>

        <p class="text-center mb-6">This page demonstrates how to make a single-page web client request using vanilla JavaScript to retrieve and display JSON data.</p>

        <!-- Button to trigger the AJAX request -->
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
                        <th class="py-3 px-6 text-left">First Name</th>
                        <th class="py-3 px-6 text-left">Last Name</th>
                        <th class="py-3 px-6 text-left">City</th>
                        <th class="py-3 px-6 text-left">State</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Points</th>
                        <th class="py-3 px-6 text-left">Gold Member</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light"></tbody>
            </table>
        </div>
    </div>

    <script>
    document.getElementById('loadData').addEventListener('click', function() {
        fetch('http://localhost:8001/api/customers')  // Ensure this is the correct endpoint
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();  // Parse the JSON from the response
            })
            .then(data => {
                const tbody = document.querySelector('#data tbody');
                tbody.innerHTML = '';  // Clear previous rows

                // Loop through the response data and append rows
                data.forEach(customer => {
                    // Append customer row
                    const customerRow = document.createElement('tr');
                    customerRow.classList.add('border-b', 'border-gray-200', 'hover:bg-gray-100');
                    customerRow.innerHTML = `
                        <td class="py-3 px-6 text-left whitespace-nowrap">${customer.first_name}</td>
                        <td class="py-3 px-6 text-left">${customer.last_name}</td>
                        <td class="py-3 px-6 text-left">${customer.city}</td>
                        <td class="py-3 px-6 text-left">${customer.state}</td>
                        <td class="py-3 px-6 text-left">${customer.phone}</td>
                        <td class="py-3 px-6 text-left">${customer.points}</td>
                        <td class="py-3 px-6 text-left">${customer.is_gold_member ? 'Yes' : 'No'}</td>
                    `;
                    tbody.appendChild(customerRow);

                    // If the customer has orders, append them as additional rows
                    if (customer.orders.length > 0) {
                        customer.orders.forEach(order => {
                            // Determine status (you can adjust based on your needs)
                            const orderStatus = order.status === 1 ? 'Pending' : 'Shipped';

                            const orderRow = document.createElement('tr');
                            orderRow.classList.add('bg-gray-50');
                            orderRow.innerHTML = `
                                <td class="py-2 px-6 text-left whitespace-nowrap" colspan="2" style="padding-left: 2rem;">Order ID: ${order.order_id}</td>
                                <td class="py-2 px-6 text-left" colspan="2">Order Date: ${order.order_date}</td>
                                <td class="py-2 px-6 text-left" colspan="2">Status: ${orderStatus}</td>
                            `;
                            tbody.appendChild(orderRow);
                        });
                    } else {
                        // If no orders, append a row indicating no orders
                        const noOrderRow = document.createElement('tr');
                        noOrderRow.classList.add('bg-gray-50');
                        noOrderRow.innerHTML = `
                            <td class="py-2 px-6 text-left" colspan="7" style="padding-left: 2rem;">No orders for this customer</td>
                        `;
                        tbody.appendChild(noOrderRow);
                    }
                });
            })
            .catch(error => {
                console.error('Error occurred:', error);
            });
    });
</script>

</body>
</html>
