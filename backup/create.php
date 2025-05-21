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
    $member_4ps = $_POST['member_4ps'];
    $middle_name = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $sex = $_POST['sex'];
    $birth_date = $_POST['birth_date'];
    $birth_place = $_POST['birth_place'];
    $age = $_POST['age'];
    $civil_status = $_POST['civil_status'];
    $nationality = $_POST['nationality'];
    $religion = $_POST['religion'];
    $occupation = $_POST['occupation'];
    $contact_number_general = $_POST['contact_number_general'];
    $pwd = $_POST['pwd'];
    $pwd_id_no = $_POST['pwd_id_no'];
    $single_parent = $_POST['single_parent'];
    $house_number = $_POST['house_number'];
    $purok_number = $_POST['purok_number'];
    $street = $_POST['street'];
    $registered_voter = $_POST['registered_voter'];
    $voter_s_id_number = $_POST['voter_s_id_number'];
    $tin_number = $_POST['tin_number'];
    $national_id_number = $_POST['national_id_number'];
    $sss_number = $_POST['sss_number'];
    $philhealth_no = $_POST['philhealth_no'];
    $pagibig_no = $_POST['pagibig_no'];
    $vaccinated = $_POST['vaccinated'];

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Add Resident</h2>

        <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                </div>
                ";
            }

        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">4Ps Member</label>
                <div class="col-sm-6">
                    <select class="form-control" name="member_4ps">
                        <option value="1" <?php if ($member_4ps) echo "selected"; ?>>Yes</option>
                        <option value="0" <?php if (!$member_4ps) echo "selected"; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Middle Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="middle_name" value="<?php echo $middle_name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Suffix</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="suffix" value="<?php echo $suffix; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sex</label>
                <div class="col-sm-6">
                    <select class="form-control" name="sex">
                        <option value="Male" <?php if ($sex == 'Male') echo "selected"; ?>>Male</option>
                        <option value="Female" <?php if ($sex == 'Female') echo "selected"; ?>>Female</option>
                        <option value="Other" <?php if ($sex == 'Other') echo "selected"; ?>>Other</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Birth Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="birth_date" value="<?php echo $birth_date; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Birth Place</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="birth_place" value="<?php echo $birth_place; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="age" value="<?php echo $age; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Civil Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="civil_status" value="<?php echo $civil_status; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nationality</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nationality" value="<?php echo $nationality; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Religion</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="religion" value="<?php echo $religion; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Occupation</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Contact Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="contact_number_general" value="<?php echo $contact_number_general; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">PWD</label>
                <div class="col-sm-6">
                    <select class="form-control" name="pwd">
                        <option value="1" <?php if ($pwd) echo "selected"; ?>>Yes</option>
                        <option value="0" <?php if (!$pwd) echo "selected"; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">PWD ID Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="pwd_id_no" value="<?php echo $pwd_id_no; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Single Parent</label>
                <div class="col-sm-6">
                    <select class="form-control" name="single_parent">
                        <option value="1" <?php if ($single_parent) echo "selected"; ?>>Yes</option>
                        <option value="0" <?php if (!$single_parent) echo "selected"; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">House Number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="house_number" value="<?php echo $house_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Purok Number</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="purok_number" value="<?php echo $purok_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Street</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="street" value="<?php echo $street; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Registered Voter</label>
                <div class="col-sm-6">
                    <select class="form-control" name="registered_voter">
                        <option value="1" <?php if ($registered_voter) echo "selected"; ?>>Yes</option>
                        <option value="0" <?php if (!$registered_voter) echo "selected"; ?>>No</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Voter's ID Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="voter_s_id_number" value="<?php echo $voter_s_id_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">TIN Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="tin_number" value="<?php echo $tin_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">National ID Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="national_id_number" value="<?php echo $national_id_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">SSS Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="sss_number" value="<?php echo $sss_number; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">PhilHealth Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="philhealth_no" value="<?php echo $philhealth_no; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Pag-IBIG Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="pagibig_no" value="<?php echo $pagibig_no; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Vaccinated</label>
                <div class="col-sm-6">
                    <select class="form-control" name="vaccinated">
                        <option value="1" <?php if ($vaccinated) echo "selected"; ?>>Yes</option>
                        <option value="0" <?php if (!$vaccinated) echo "selected"; ?>>No</option>
                    </select>
                </div>
            </div>


            <?php 
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3 d-grid'>
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                        </div>
                    </div>
                </div>    
                ";
            }

            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/account/index.php" role="button">Cancel</a>    
                </div>
            </div>
        </form>
    </div>
</body>
</html>