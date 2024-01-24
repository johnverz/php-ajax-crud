<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Barangay Information System</title>
</head>
<body>

<div class="container mt-4">
    <h2 class="display-4 mb-5">Barangay Information System</h2>
    <div class="row">
        <div class="col-6">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add Record</button>
            <button class="btn btn-success mb-3" onclick="refreshRecords()">Refresh</button>

        </div>
        <div class="col-6">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" placeholder="Enter keyword" aria-describedby="search-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="search-addon">
                        <span class="fa fa-search"></span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>No.</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Gender</th>
            <th>Birth Date</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="tableBody">
            <!-- Auto-populated via javascript -->
        </tbody>
    </table>
</div>

<!-- Add Record Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="middle_name">Middle Name:</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bdate">Birth Date:</label>
                            <input type="date" class="form-control" id="bdate" name="bdate" required>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Record</button>
                    </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Fetch and display records on page load
    $(document).ready(function () {
        fetchRecords();  //populate the table at load

        // Search functionality
        $('#search').on('input', function () {
            fetchRecords();
        });
    });

    // Function to fetch and display records
    function fetchRecords() {
        // Get the search keyword
        var keyword = $('#search').val();

        $.ajax({
            url: 'ajax.php',
            method: 'GET',
            data: { keyword: keyword }, // Pass the keyword to the server
            dataType: 'html',
            success: function (data) {
                $('#tableBody').html(data);
            }
        });
    }


    // Submit form using Ajax
    $('#addForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'ajax.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function () {
                // Refresh records after adding
                fetchRecords();
                // Close the modal
                $('#addModal').modal('hide');
                // Clear the form fields
                $('#addForm')[0].reset();
            }
        });
    });

    // Function to manually refresh records
    function refreshRecords() {
        fetchRecords();
    }
</script>

</body>
</html>
