<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-dark-subtle">
    <?php
    require 'connect.php';
    $id = 0;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $dtbQuery = "SELECT * FROM information_tbl WHERE ID_NUM=$id";
    $container = $conn->query($dtbQuery);
    while ($data = $container->fetch_assoc()) {
    ?>

        <div class="container mt-5 mb-5 pb-3 card bg-body-tertiary">
            <h1 class="mt-4">Edit Contact of ID Number <?php echo "<b><u>$id</u></b>" ?></h1>
            <form action="edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ?>">


                <div class="container pt-3 mb-5">
                    <div class="container col-4">
                        <img src="../MTR/images/<?php echo $data['IMAGE']; ?>" alt="Profile Picture" class="rounded img-fluid img-thumbnail">
                    </div>
                </div>

                <div class="mb-3 pt-5">
                    <div id="round" name="imgholder" class="mb-5 text-center"></div>
                    <label for="picture" class="form-label fw-semibold">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture" accept="image/jpeg, image/jpg, image/png" required>
                </div>

                <div class="mb-3">
                    <label for="firstname" class="form-label fw-bold">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $data['FIRSTNAME']; ?>" pattern="[A-Za-z ]+" title="Please enter a valid first name (letters only)" required>
                </div>


                <div class="mb-3">
                    <label for="lastname" class="form-label fw-semibold">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $data['LASTNAME']; ?>" pattern="[A-Za-z ]+" title="Please enter a valid last name (letters only)" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['ADDRESS']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Sex</label><br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="male" name="sex" value="Male" <?php if ($data['SEX'] == 'Male') echo 'checked'; ?> required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="female" name="sex" value="Female" <?php if ($data['SEX'] == 'Female') echo 'checked'; ?>>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="other" name="sex" value="Other" <?php if ($data['SEX'] == 'Other') echo 'checked'; ?>>
                        <label class="form-check-label" for="other">Other</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label fw-semibold">Mobile Number</label>
                    <input type="number" class="form-control" id="mobile" name="mobile" value="<?php echo $data['MOB_NUM']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['EMAIL']; ?>" required>
                </div>
                <div class="row">
                    <div class="col text-end">
                        <button type="submit" class="btn btn-primary fw-semibold" name="update">Update Contact</button>
                        <a href="javascript:history.go(-1)" class="btn btn-secondary fw-semibold">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

    <?php
    }
    ?>

    <?php
    function sanitize($inputData)
    {
        foreach ($inputData as &$value) {
            $value = trim($value);
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $value = stripslashes($value);
        }
        return $inputData;
    }

    if (isset($_POST['update'])) {

        $inputData = array(
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'address' => $_POST['address'],
            'mobile' => $_POST['mobile'],
            'email' => $_POST['email']
        );
        $Imagename = $_FILES['picture']['name'];
        $Imagetype = $_FILES['picture']['type'];
        $Imagesize = $_FILES['picture']['size'];
        $tmp_name = $_FILES['picture']['tmp_name'];
        // Sanitize the input data
        $sanitizedData = sanitize($inputData);

        // Now $sanitizedData contains the sanitized values
        $id = $_POST['id'];
        $firstname = $sanitizedData['firstname'];
        $lastname = $sanitizedData['lastname'];
        $address = $sanitizedData['address'];
        $sex = $_POST['sex'];
        $Ssex = "";

        if ($sex == "Male") {
            $Ssex = "Male";
        } else if ($sex == "Female") {
            $Ssex = "Female";
        } else if ($sex == "Other") {
            $Ssex = "Other";
        }

        $mobile = $sanitizedData['mobile'];
        $email = $sanitizedData['email'];
        require 'connect.php';

        if (move_uploaded_file($tmp_name, "../MTR/images/" . $Imagename)) {
            $dtbQuery = "UPDATE information_tbl SET IMAGE='$Imagename' WHERE ID_NUM=$id";
            $container = $conn->query($dtbQuery) or die("Could not perform $dtbQuery");
        } else {
            echo "error";
        }

        $dtbQuery = "UPDATE information_tbl SET FIRSTNAME='$firstname', LASTNAME='$lastname', ADDRESS='$address', SEX='$Ssex', MOB_NUM='$mobile', EMAIL='$email' WHERE ID_NUM=$id";
        $container = $conn->query($dtbQuery) or die("Could not perform $dtbQuery");
        echo "<script>Swal.fire(
                        'Good job!',
                        'The record has been updated!',
                        'success'
                      )</script>";
        header("Refresh:1;url=index.php");
    }

    ?>
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
                        img.style.maxWidth = "100px"; // Set maximum width
                        img.style.maxHeight = "100px"; // Set maximum height
                        roundDiv.innerHTML = ""; // Clear any previous content
                        roundDiv.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>