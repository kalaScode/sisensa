<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authorization Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Authorization Management</h2>
        <ul class="nav nav-tabs" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="roles-tab" data-bs-toggle="tab" data-bs-target="#roles"
                    type="button" role="tab">Role Management</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button"
                    role="tab">User Role Assignment</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="permissions-tab" data-bs-toggle="tab" data-bs-target="#permissions"
                    type="button" role="tab">Access Permissions</button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="authTabsContent">
            <!-- Role Management Tab -->
            <div class="tab-pane fade show active" id="roles" role="tabpanel">
                <h3>Role Management</h3>
                <button class="btn btn-primary mb-3" onclick="openAddRoleModal()">Add Role</button>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="roleTableBody">
                        <!-- Dynamic Content -->
                    </tbody>
                </table>
            </div>

            <!-- User Role Assignment Tab -->
            <div class="tab-pane fade" id="users" role="tabpanel">
                <h3>User Role Assignment</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Role(s)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- Dynamic Content -->
                    </tbody>
                </table>
            </div>

            <!-- Access Permissions Tab -->
            <div class="tab-pane fade" id="permissions" role="tabpanel">
                <h3>Access Permissions</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Sub-menu</th>
                            <th>Role</th>
                            <th>Permissions</th>
                        </tr>
                    </thead>
                    <tbody id="permissionsTableBody">
                        <!-- Dynamic Content -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addRoleForm">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" required>
                        </div>
                        <div class="mb-3">
                            <label for="roleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="roleDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permissionView">
                                <label class="form-check-label" for="permissionView">View</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permissionEdit">
                                <label class="form-check-label" for="permissionEdit">Edit</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permissionDelete">
                                <label class="form-check-label" for="permissionDelete">Delete</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveRole()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function openAddRoleModal() {
            const modal = new bootstrap.Modal(document.getElementById('addRoleModal'));
            modal.show();
        }

        function saveRole() {
            const roleName = document.getElementById('roleName').value;
            const roleDescription = document.getElementById('roleDescription').value;
            const permissions = [];

            if (document.getElementById('permissionView').checked) permissions.push('View');
            if (document.getElementById('permissionEdit').checked) permissions.push('Edit');
            if (document.getElementById('permissionDelete').checked) permissions.push('Delete');

            // Example for appending to the table
            const tableBody = document.getElementById('roleTableBody');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${roleName}</td>
                <td>${roleDescription}</td>
                <td>${permissions.join(', ')}</td>
            `;
            tableBody.appendChild(newRow);

            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addRoleModal'));
            modal.hide();
        }
    </script>
</body>

</html>
