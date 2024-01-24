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
        
        <div class="col-8">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" placeholder="Enter keyword" aria-describedby="search-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="search-addon">
                        <span class="fa fa-search"></span>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-4">
            <button class="btn btn-primary mb-3 float-right ml-2" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Add Record</button>
            <button class="btn btn-success mb-3 float-right" onclick="fetchRecords()"><i class="fas fa-sync-alt"></i> Refresh Table</button>
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
            <th></th>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit record form goes here -->
                <form id="editForm">
                    <div class="form-group">
                        <label for="edit_last_name">Last Name:</label>
                        <input type="text" class="form-control" id="edit_last_name" name="edit_last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_first_name">First Name:</label>
                        <input type="text" class="form-control" id="edit_first_name" name="edit_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_middle_name">Middle Name:</label>
                        <input type="text" class="form-control" id="edit_middle_name" name="edit_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="edit_gender">Gender:</label>
                        <select class="form-control" id="edit_gender" name="edit_gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_bdate">Birth Date:</label>
                        <input type="date" class="form-control" id="edit_bdate" name="edit_bdate" required>
                    </div>
                    <input type="hidden" id="edit_record_id" name="edit_record_id"> <!-- Hidden input to store record ID -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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

    // Function to show confirmation modal before deleting a record
    function showConfirmDeleteModal(id) {
        $('#confirmDeleteButton').data('recordId', id); // Store the record ID in the button's data attribute
        $('#confirmDeleteModal').modal('show');
    }

    // Function to handle the delete operation
    function deleteRecord() {
        var id = $('#confirmDeleteButton').data('recordId'); // Retrieve the stored record ID
        // Perform the delete operation using AJAX
        $.ajax({
            url: 'delete.php', // Create a separate PHP file for handling delete operation
            method: 'POST',
            data: { id: id },
            success: function () {
                // Refresh records after deleting
                fetchRecords();
                // Close the confirmation modal
                $('#confirmDeleteModal').modal('hide');
            }
        });
    }

    // Event listener for the confirmDeleteButton click
    $('#confirmDeleteButton').on('click', function () {
        deleteRecord(); // Call the deleteRecord function when the button is clicked
    });

    // Event listener for the delete button in the table
    $('#tableBody').on('click', '.btn-danger', function () {
        var recordId = $(this).data('record-id');
        showConfirmDeleteModal(recordId);
    });

    // Event listener for the edit button in the table
    $('#tableBody').on('click', '.btn-warning', function () {
        var recordId = $(this).data('record-id');
        var lastName = $(this).closest('tr').find('td:eq(1)').text();
        var firstName = $(this).closest('tr').find('td:eq(2)').text();
        var middleName = $(this).closest('tr').find('td:eq(3)').text();
        var gender = $(this).closest('tr').find('td:eq(4)').text();
        var bdate = $(this).closest('tr').find('td:eq(5)').text();
        showEditModal(recordId, lastName, firstName, middleName, gender, bdate);
    });

     // Function to show edit modal with record details
     function showEditModal(id, last_name, first_name, middle_name, gender, bdate) {
        $('#edit_record_id').val(id); // Set the record ID in the hidden input
        $('#edit_last_name').val(last_name);
        $('#edit_first_name').val(first_name);
        $('#edit_middle_name').val(middle_name);
        $('#edit_gender').val(gender);
        $('#edit_bdate').val(bdate);
        $('#editModal').modal('show');
    }

    // Submit edit form using Ajax
    $('#editForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'edit.php', // Create a separate PHP file for handling edit operation
            method: 'POST',
            data: $(this).serialize(),
            success: function () {
                // Refresh records after editing
                fetchRecords();
                // Close the edit modal
                $('#editModal').modal('hide');
            }
        });
    });



    
</script>

</body>
</html>
