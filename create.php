<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "residents";

$connection = new mysqli($servername ,$username, $password, $database); // create connection

$last_name = "";
$first_name = "";
$member_4ps = false; // bool
$middle_name = "";
$suffix = "";
$sex = "";
$birth_date = null; // date (nullable)
$birth_place = "";
$age = 0; // int
$civil_status = ""; 
$nationality = "";
$religion = "";
$occupation = "";
$contact_number_general = ""; // keep as string to preserve leading 0s
$pwd = false; // bool
$pwd_id_no = 0; // int
$single_parent = false; // bool
$house_number = 0; // int
$purok_number = 0; // int
$street = ""; 
$registered_voter = false; // bool
$voter_s_id_number = 0; // int
$tin_number = 0; // int
$national_id_number = 0; // int
$sss_number = 0; // int
$philhealth_no = 0; // int
$pagibig_no = 0; // int
$vaccinated = false; // bool

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $last_name = $_POST["last_name"];
    $first_name = $_POST['first_name'];
    $member_4ps = $_POST['member_4ps'] ?? '';
    $middle_name = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $sex = $_POST['sex'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $birth_place = $_POST['birth_place'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_status'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $occupation = $_POST['occupation'];
    $contact_number_general = $_POST['contact_number_general'];
    $pwd = $_POST['pwd'] ?? '';
    $pwd_id_no = $_POST['pwd_id_no'];
    $single_parent = $_POST['single_parent'] ?? '';
    $house_number = $_POST['house_number'];
    $purok_number = $_POST['purok_number'];
    $street = $_POST['street'];
    $registered_voter = $_POST['registered_voter'] ?? '';
    $voter_s_id_number = $_POST['voter_s_id_number'];
    $tin_number = $_POST['tin_number'];
    $national_id_number = $_POST['national_id_number'];
    $sss_number = $_POST['sss_number'];
    $philhealth_no = $_POST['philhealth_no'];
    $pagibig_no = $_POST['pagibig_no'];
    $vaccinated = $_POST['vaccinated'] ?? '';

    do {
        if  (empty($last_name) || 
            empty($first_name) || 
            !isset($member_4ps) || // boolean, so check isset()
            empty($sex) || 
            empty($birth_date) || 
            empty($birth_place) || 
            !isset($age) || // int, so check isset()
            empty($civil_status) || 
            empty($nationality) || 
            empty($religion) || 
            empty($occupation) || 
            empty($contact_number_general) || 
            !isset($pwd) || // boolean
            !isset($single_parent) || // boolean
            !isset($house_number) || // int
            !isset($purok_number) || // int
            empty($street) || 
            !isset($registered_voter) || // boolean
            !isset($vaccinated)) { // boolean
            $errorMessage = "Requied fields must have something in them";
            break;
        }

        $sql = "INSERT INTO residents (
                last_name, first_name, member_4ps, middle_name, suffix, sex, birth_date, birth_place,
                age, civil_status, nationality, religion, occupation, contact_number_general,
                pwd, pwd_id_no, single_parent, house_number, purok_number, street,
                registered_voter, voter_s_id_number, tin_number, national_id_number,
                sss_number, philhealth_no, pagibig_no, vaccinated
            ) VALUES (
                '$last_name', '$first_name', '$member_4ps', '$middle_name', '$suffix', '$sex', '$birth_date', '$birth_place',
                $age, '$civil_status', '$nationality', '$religion', '$occupation', '$contact_number_general',
                '$pwd', '$pwd_id_no', '$single_parent', $house_number, $purok_number, '$street',
                '$registered_voter', '$voter_s_id_number', '$tin_number', '$national_id_number',
                '$sss_number', '$philhealth_no', '$pagibig_no', '$vaccinated'
            )";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid Query: " . $connection->error;
            break;
        }


        // add new client to database
        $last_name = "";
        $first_name = "";
        $member_4ps = false; // bool
        $middle_name = "";
        $suffix = "";
        $sex = "";
        $birth_date = null; // date (nullable)
        $birth_place = "";
        $age = 0; // int
        $civil_status = ""; 
        $nationality = "";
        $religion = "";
        $occupation = "";
        $contact_number_general = ""; // keep as string to preserve leading 0s
        $pwd = false; // bool
        $pwd_id_no = 0; // int
        $single_parent = false; // bool
        $house_number = 0; // int
        $purok_number = 0; // int
        $street = ""; 
        $registered_voter = false; // bool
        $voter_s_id_number = 0; // int
        $tin_number = 0; // int
        $national_id_number = 0; // int
        $sss_number = 0; // int
        $philhealth_no = 0; // int
        $pagibig_no = 0; // int
        $vaccinated = false; // bool

        $successMessage = "Resident has been added";

        header("location: /accounts/index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident</title>
    <link rel="stylesheet" href="resident-data.css">
</head>
<body>
    <?php 
        if (!empty($errorMessage)) {
            echo "<script>alert('" . addslashes($errorMessage) . "');</script>";
        }
    ?>

    <div class="main-tab">
        <div class="tab">
            <button id="dashboard-tab"></button>
            <button id="analytics-tab"></button>
            <button id="database-tab"></button>
            <button id="filing-tab"></button>
            <button id="user-account-tab"></button>
            <div class="shade"></div>
            <div class="separator"></div>
            <div class="picture">
                <div class="picture-image">
                    <img src="images/user.png" alt="profile-picture" class="profile-picture">
                </div>
                <button class="picture-button">Upload Picture</button>
            </div>
            <div class="general-data">
                <label for="resident-data" id="resident-data-text">Resident Data</label>

        <form method="post">
            <input type="text" class="last-name" name="last_name"
                <?php if (!empty($last_name)) echo 'value="' . htmlspecialchars($last_name) . '"'; ?>
                placeholder="Last Name" style="color: #57977C;top: 22%; left: 32%;">

            <input type="text" class="first-name" name="first_name"
                <?php if (!empty($first_name)) echo 'value="' . htmlspecialchars($first_name) . '"'; ?>
                placeholder="First Name" style="color: #57977C;top: 22%; left: 48%;">

            <input type="text" class="middle-name" name="middle_name"
                <?php if (!empty($middle_name)) echo 'value="' . htmlspecialchars($middle_name) . '"'; ?>
                placeholder="Middle Name" style="color: #57977C;top: 22%; left: 64%;">

            <input type="text" class="suffix" name="suffix"
                <?php if (!empty($suffix)) echo 'value="' . htmlspecialchars($suffix) . '"'; ?>
                placeholder="Suffix" style="color: #57977C;top: 22%; left: 80%;">

            <select class="sex" name="sex" style="color: #57977C;top: 32%; left: 32%; width: 14.5%; height: 6%;">
                <option value="" disabled selected hidden>Select Sex</option>
                <option value="Male" <?php if ($sex == 'Male') echo "selected"; ?>>Male</option>
                <option value="Female" <?php if ($sex == 'Female') echo "selected"; ?>>Female</option>
            </select>
            <input placeholder="Date of Birth" class="birth-date" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"
                <?php if (!empty($birth_date)) echo 'value="' . htmlspecialchars($birth_date) . '"'; ?>
                style="color: #57977C; top: 32%; left: 48%;">

            <input type="text" class="birth-place" name="birth_place"
                <?php if (!empty($birth_place)) echo 'value="' . htmlspecialchars($birth_place) . '"'; ?>
                placeholder="Place of Birth" style="color: #57977C;top: 32%; left: 64%;">

            <input type="number" class="age" name="age"
                <?php if (!empty($age)) echo 'value="' . htmlspecialchars($age) . '"'; ?>
                placeholder="Age" style="color: #57977C;top: 32%; left: 80%;">

            <input type="text" class="civil-status" name="civil_status"
                <?php if (!empty($civil_status)) echo 'value="' . htmlspecialchars($civil_status) . '"'; ?>
                placeholder="Civil Status" style="color: #57977C;top: 42%; left: 32%;">

            <input type="text" class="nationality" name="nationality"
                <?php if (!empty($nationality)) echo 'value="' . htmlspecialchars($nationality) . '"'; ?>
                placeholder="Nationality" style="color: #57977C;top: 42%; left: 48%;">

            <input type="text" class="religion" name="religion"
                <?php if (!empty($religion)) echo 'value="' . htmlspecialchars($religion) . '"'; ?>
                placeholder="Religion" style="color: #57977C;top: 42%; left: 64%;">

            <input type="text" class="occupation" name="occupation"
                <?php if (!empty($occupation)) echo 'value="' . htmlspecialchars($occupation) . '"'; ?>
                placeholder="Occupation" style="color: #57977C;top: 42%; left: 80%;">

            <input type="text" class="contact-number-general" name="contact_number_general"
                <?php if (!empty($contact_number_general)) echo 'value="' . htmlspecialchars($contact_number_general) . '"'; ?>
                placeholder="Contact Number" style="color: #57977C;top: 52%; left: 32%;">

            <select class="pwd" name="pwd" style="color: #57977C;top: 52%; left: 48%; width: 14.5%; height: 6%;">
                <option value="1" <?php if ($pwd) echo "selected"; ?>>Yes</option>
                <option value="0" <?php if (!$pwd) echo "selected"; ?>>No</option>
                <option value="" disabled selected hidden>PWD?</option>
            </select>

            <input type="text" class="pwd-id-no" name="pwd_id_no"
                <?php if (!empty($pwd_id_no)) echo 'value="' . htmlspecialchars($pwd_id_no) . '"'; ?>
                placeholder="PWD ID No." style="color: #57977C;top: 52%; left: 64%;">

            <select class="single-parent" name="single_parent" style="color: #57977C;top: 52%; left: 80%; width: 14.5%; height: 6%;">
                <option value="1" <?php if ($single_parent) echo "selected"; ?>>Yes</option>
                <option value="0" <?php if (!$single_parent) echo "selected"; ?>>No</option>
                <option value="" disabled selected hidden>Single Parent?</option>
            </select>

            <input type="number" class="house-number" name="house_number"
                <?php if (!empty($house_number)) echo 'value="' . htmlspecialchars($house_number) . '"'; ?>
                placeholder="House No." style="color: #57977C;top: 62%; left: 32%;">

            <input type="number" class="purok-number" name="purok_number"
                <?php if (!empty($purok_number)) echo 'value="' . htmlspecialchars($purok_number) . '"'; ?>
                placeholder="Purok No." style="color: #57977C;top: 62%; left: 48%;">

            <input type="text" class="street" name="street"
                <?php if (!empty($street)) echo 'value="' . htmlspecialchars($street) . '"'; ?>
                placeholder="Street" style="color: #57977C;top: 62%; left: 64%;">

            <select class="registered-voter" name="registered_voter" style="color: #57977C;top: 62%; left: 80%; width: 14.5%; height: 6%;">
                <option value="1" <?php if ($registered_voter) echo "selected"; ?>>Yes</option>
                <option value="0" <?php if (!$registered_voter) echo "selected"; ?>>No</option>
                <option value="" disabled selected hidden>Registered Voter?</option>
            </select>

            <select class="member-4ps" name="member_4ps" style="color: #57977C;top: 72%; left: 32%; width: 14.5%; height: 6%;">
                
                <option value="1" <?php if ($member_4ps) echo "selected"; ?>>Yes</option>
                <option value="0" <?php if (!$member_4ps) echo "selected"; ?>>No</option>
                <option value="" disabled selected hidden>4ps Member?</option>
            </select>

            <input type="text" class="voter-s-id-number" name="voter_s_id_number"
                <?php if (!empty($voter_s_id_number)) echo 'value="' . htmlspecialchars($voter_s_id_number) . '"'; ?>
                placeholder="Voter's ID No." style="color: #57977C;top: 72%; left: 48%;">

            <input type="text" class="tin-number" name="tin_number"
                <?php if (!empty($tin_number)) echo 'value="' . htmlspecialchars($tin_number) . '"'; ?>
                placeholder="TIN Number" style="color: #57977C;top: 72%; left: 64%;">

            <input type="text" class="national-id-number" name="national_id_number"
                <?php if (!empty($national_id_number)) echo 'value="' . htmlspecialchars($national_id_number) . '"'; ?>
                placeholder="National ID Number" style="color: #57977C;top: 72%; left: 80%;">

            <input type="text" class="sss-number" name="sss_number"
                <?php if (!empty($sss_number)) echo 'value="' . htmlspecialchars($sss_number) . '"'; ?>
                placeholder="SSS Number" style="color: #57977C;top: 82%; left: 32%;">

            <input type="text" class="philhealth-no" name="philhealth_no"
                <?php if (!empty($philhealth_no)) echo 'value="' . htmlspecialchars($philhealth_no) . '"'; ?>
                placeholder="PhilHealth No." style="color: #57977C;top: 82%; left: 48%;">

            <input type="text" class="pagibig-no" name="pagibig_no"
                <?php if (!empty($pagibig_no)) echo 'value="' . htmlspecialchars($pagibig_no) . '"'; ?>
                placeholder="PAG-IBIG No." style="color: #57977C;top: 82%; left: 64%;">

            <select class="vaccinated" name="vaccinated" style="color: #57977C;top: 82%; left: 80%; width: 14.5%; height: 6%;">
                
                <option value="1" <?php if ($vaccinated) echo "selected"; ?>>Yes</option>
                <option value="0" <?php if (!$vaccinated) echo "selected"; ?>>No</option>
                <option value="" disabled selected hidden>Vaccinated?</option>
            </select>
            <?php 
            if (!empty($successMessage)) {
                echo "<script>alert('" . addslashes($successMessage) . "');</script>";
            }
            ?>
            <div class="emergency-info">
                <label for="emergency-information" id="emergency-information-text">Emergency Infomation</label>
                <input type="text" placeholder="Full Name" class="full-name" required>
                <input type="text" placeholder="Relationship" class="relationship" required>
                <input type="text" placeholder="Contact No." class="contact-number" required>
                <input type="text" placeholder="Address" class="address" required>
                <button type="submit" class="add-resident" style="position: absolute;
                                                                top: 84%; /* slight offset from the top */
                                                                left: 8%;
                                                                width: 40%;
                                                                height: 12%;
                                                                border-radius: 15px;
                                                                border: none;
                                                                background: #57977C;
                                                                color: #ffffff;
                                                                font-size: 20px;
                                                                font-weight: 500; /* very bold */
                                                                font-family: 'Inter', sans-serif; /* <-- use Inter */
                                                                cursor: pointer;">Submit</button>
                <a class="cancel" href="/accounts/index.php" role="button" style=" position: absolute;
                                                                top: 84%; /* slight offset from the top */
                                                                left: 53%;
                                                                width: 40%;
                                                                height: 12%;
                                                                border-radius: 15px;
                                                                border: none;
                                                                background: #57977C;
                                                                color: #ffffff;
                                                                font-size: 20px;
                                                                font-weight: 500; /* very bold */
                                                                font-family: 'Inter', sans-serif; /* <-- use Inter */
                                                                display: flex; 
                                                                align-items: center;
                                                                justify-content: center;
                                                                cursor: pointer;"> Cancel </a>
            </div>
        </form>
    </div>
</body>
</html>