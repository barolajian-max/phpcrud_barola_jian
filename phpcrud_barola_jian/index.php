<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Yung sarili mong style.css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="crud-container">
            <div class="header-section">
                <div>
                    <h3 class="header-title">Student Information Directory</h3>
                    <small class="text-muted">Manage student records</small>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    + Add Student
                </button>
            </div>

            <!-- Add Modal -->
            <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="insert.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Add New Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">First Name</label>
                                    <input type="text" name="firstname" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Last Name</label>
                                    <input type="text" name="lastname" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary px-4">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col" class="text-center" style="width: 220px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'database.php';

                        $query = "SELECT id, firstname, lastname FROM students";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_result($id, $firstname, $lastname);
                        $stmt->execute();

                        while ($stmt->fetch()) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($firstname); ?></td>
                                <td><?php echo htmlspecialchars($lastname); ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#edit<?php echo $id; ?>">
                                        Edit
                                    </button>
                                    <a href="delete.php?id=<?php echo $id; ?>" onclick="return confirm('Sigurado ka bang buburahin ito?');" class="btn btn-sm btn-danger">
                                        Delete
                                    </a>

                                    <!-- Edit Modal -->
                                    <div class="modal fade text-start" id="edit<?php echo $id; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="update.php" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold">Edit Student</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">First Name</label>
                                                            <input type="text" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" class="form-control" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Last Name</label>
                                                            <input type="text" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary px-4">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle sa dulo para siguradong gagana ang modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>