<div class="table-container">
    <table id="nameTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
            </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>
</div>

<script>
    function populateDefaultData() {
        const defaultData = [
            { name: 'John Doe' },
            { name: 'Jane Smith' },
            { name: 'Alice Johnson' },
            { name: 'Bob Brown' },
            { name: 'Charlie Davis' }
        ];

        const tableBody = document.getElementById('tableBody');
        defaultData.forEach((applicant, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `<td>${index + 1}</td><td>${applicant.name}</td>`;
            tableBody.appendChild(row);
        });
    }

    function fetchNames() {
        fetch('https://example.com/api/getNames')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('tableBody');
                tableBody.innerHTML = '';
                data.forEach((applicant, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${index + 1}</td><td>${applicant.name}</td>`;
                    tableBody.appendChild(row);
                });
            })
            .catch((error) => {
                console.error('Error fetching names:', error);
            });
    }

    function updateDatabase() {
        const tableData = [];
        const rows = document.querySelectorAll('#nameTable tbody tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowData = {
                id: cells[0].innerText,
                name: cells[1].innerText
            };
            tableData.push(rowData);
        });

        fetch('https://example.com/api/updateNames', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(tableData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }


    populateDefaultData();
    fetchNames();
</script>

@assets
<style>
    .table-container {
        max-height: 500px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        background-color: white;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 12px;
        text-align: left;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    th {
        background-color: #DCDCDC;
        color: black;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover td {
        background-color: #e0e7ff;
    }
    tr:first-child th:first-child {
        border-top-left-radius: 10px;
    }
    tr:first-child th:last-child {
        border-top-right-radius: 10px;
    }
    tr:last-child td:first-child {
        border-bottom-left-radius: 10px;
    }
    tr:last-child td:last-child {
        border-bottom-right-radius: 10px;
    }
</style>
@endassets
