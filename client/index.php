<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Response Example</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Include Tailwind CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        /* Table header gradient */
        thead {
            background: linear-gradient(90deg, #667eea, #764ba2);
        }
        thead th {
            color: white;
        }
        /* Row striping */
        tbody tr:nth-child(odd) {
            background-color: #f3f4f6; /* light gray */
        }
        tbody tr:nth-child(even) {
            background-color: #ffffff; /* white */
        }
        /* Hover effect for rows */
        tbody tr:hover {
            background-color: #e2e8f0; /* light blue on hover */
        }
        /* Card styling */
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            padding: 1.5rem;
        }
        /* Order row styling */
        .order-row {
            background-color: #edf2f7; /* Slightly different background for orders */
            border-left: 4px solid #667eea; /* Colored left border for orders */
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold mb-6 text-center text-white">Customer Orders</h1>

        <p class="text-center text-white mb-6">This page demonstrates how to make a single-page web client request using vanilla JavaScript to retrieve and display JSON data.</p>

        <!-- Button to trigger the AJAX request -->
        <div class="flex justify-center mb-8">
            <button id="loadData" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-full shadow-lg transition-all">
                Load Data
            </button>
        </div>

        <!-- Card-like Table for displaying data -->
        <div class="card">
            <table id="data" class="min-w-full table-auto bg-white rounded-lg">
                <thead>
                    <tr class="uppercase text-sm leading-normal">
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
                    customerRow.classList.add('border-b', 'border-gray-200');
                    customerRow.innerHTML = `
                        <td class="py-3 px-6 text-left whitespace-nowrap font-semibold">${customer.first_name}</td>
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
                            const statusColor = order.status === 1 ? 'text-yellow-600' : 'text-green-600';

                            const orderRow = document.createElement('tr');
                            orderRow.classList.add('border-b', 'border-gray-200', 'order-row');
                            orderRow.innerHTML = `
                                <td class="py-2 px-6 text-left whitespace-nowrap" colspan="3" style="padding-left: 2rem;">Order ID: ${order.order_id}</td>
                                <td class="py-2 px-6 text-left" colspan="2">Order Date: ${order.order_date}</td>
                                <td class="py-2 px-6 text-left ${statusColor}" colspan="2">Status: ${orderStatus}</td>
                            `;
                            tbody.appendChild(orderRow);
                        });
                    } else {
                        // If no orders, append a row indicating no orders
                        const noOrderRow = document.createElement('tr');
                        noOrderRow.classList.add('border-b', 'border-gray-200', 'order-row');
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
