<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>

<body>

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
    if (isset($_POST['add'])) {

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
        // if(!file_exists("../websysMTR/images")){
       
        if (move_uploaded_file($tmp_name, "../MTR/images/" . $Imagename)) {
        } else {
            echo "error";
        }
        $dtbQuery = "INSERT INTO information_tbl (FIRSTNAME, LASTNAME, ADDRESS, SEX, MOB_NUM, EMAIL, IMAGE)
            VALUES ('$firstname', '$lastname', '$address', '$Ssex','$mobile','$email','$Imagename')";
        $container = $conn->query($dtbQuery) or die("Could not perform $dtbQuery");
        echo "<script>Swal.fire(
                'Good job!',
                'Record has been saved successfully!',
                'success'
              )</script>";
        header("Refresh:1;url=index.php");
    } else {
        header("Refresh:1;url=index.php");
    }
    ?>


</body>

</html>