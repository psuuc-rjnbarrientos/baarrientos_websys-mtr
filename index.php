<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Manager</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Y6yymIvR6vZYq1cIwJphfXnYrr3IMBkEOm5mzVa8SeFez3B" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <script>
        $(function() {
            $("#myTable").DataTable();
        });
    </script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-dark-subtle">
    <div class="container mt-5 pb-3 card bg-body-secondary">
        <h1 class="mt-4">Contact Manager</h1>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div class="pt-5 mb-5">
                <div id="round" name="imgholder" class=" text-center"></div>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label fw-semibold">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture" accept="image/jpeg, image/jpg, image/png" required>
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label fw-semibold">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" pattern="[A-Za-z ]+" title="Please enter a valid first name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label fw-semibold">Last Name</label>
                <input type="text" class="form-control fw-semibold" id="lastname" name="lastname" pattern="[A-Za-z ]+" title="Please enter a valid last name (letters only)" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label fw-semibold">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Sex</label><br>
                <input type="radio" id="male" name="sex" value="Male" required>
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="sex" value="Female">
                <label for="female">Female</label><br>
                <input type="radio" id="other" name="sex" value="Other">
                <label for="other">Other</label><br>
            </div>

            <div class="mb-3">
                <label for="mobile" class="form-label fw-semibold">Mobile Number</label>
                <input type="number" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="row">
                <div class="col text-end">
                    <button type="submit" class="btn btn-primary fw-semibold" name="add">Add Contact</button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-5 container mx-auto card p-3 bg-light-subtle">
        <div class="mb-3">
            <table id="myTable" class="table">
                <thead>
                    <tr class="table-primary">
                        <th class="text-center">ID Number</th>
                        <th class="text-center">Firstname</th>
                        <th class="text-center">Lastname</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Sex</th>
                        <th class="text-center">Mobile Number</th>
                        <th class="text-center">Email Address</th>
                        <th class="text-center">Picture</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    require 'connect.php';
                    $dtbQuery = "SELECT * FROM information_tbl";
                    $container = $conn->query($dtbQuery);
                    while ($data = $container->fetch_assoc()) {
                    ?>

                        <tr class="table-info">
                            <th scope="row" class="table-secondary text-center"><?php echo $data['ID_NUM'] ?></th>
                            <td class="text-center fw-semibold"><?php echo $data['FIRSTNAME'] ?></td>
                            <td class="text-center fw-semibold"><?php echo $data['LASTNAME'] ?></td>
                            <td class="text-start fw-semibold"><?php echo $data['ADDRESS'] ?></td>
                            <td class="text-center fw-semibold"><?php echo $data['SEX'] ?></td>
                            <td class="text-center fw-semibold"><?php echo $data['MOB_NUM'] ?></td>
                            <td class="text-center fw-semibold"><?php echo $data['EMAIL'] ?></td>
                            <td class="text-center">
                                <img src="../MTR/images/<?php echo $data['IMAGE']; ?>" alt="Picture" class="img-fluid img-thumbnail">
                            </td>

                            <td class="table-secondary text-center">
                                <?php
                                echo '<a href="edit.php?id=' . $data['ID_NUM'] . '"> <button class="btn btn-outline-secondary mb-2 fw-semibold text-body" id="edit" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 1.37rem; --bs-btn-font-size: .rem;">Edit</button></a>';
                                echo '<a href="delete.php?id=' . $data['ID_NUM'] . '"><button class="btn btn-dark fw-semibold" id="delete">Delete</button></a>';
                                ?>
                            </td>
                        </tr>

                    <?php
                    }
                    $container->free_result();
                    $conn->close();
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById("picture");
            const roundDiv = document.getElementById("round");

            imageInput.addEventListener("change", function() {
                const file = imageInput.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style.maxWidth = "100px";
                        img.style.maxHeight = "100px";
                        roundDiv.innerHTML = "";
                        roundDiv.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>