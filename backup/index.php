<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Accounts</h2>
        <a class="btn btn-primary" href="/accounts/create.php" role="button">New Account</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th> <th>Last Name</th> <th>First Name</th> <th>4Ps Member</th> <th>Middle Name</th> <th>Suffix</th> <th>Sex</th> <th>Birth Date</th> <th>Birth Place</th> <th>Age</th> <th>Civil Status</th> <th>Nationality</th> <th>Religion</th> <th>Occupation</th> <th>Contact #</th> <th>PWD</th> <th>PWD ID No.</th> <th>Single Parent</th> <th>House #</th> <th>Purok #</th> <th>Street</th> <th>Registered Voter</th> <th>Voter's ID</th> <th>TIN #</th> <th>National ID #</th> <th>SSS #</th> <th>PhilHealth #</th> <th>Pag-IBIG #</th> <th>Vaccinated</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "residents";
                
                $connection = new mysqli($servername ,$username, $password, $database); // create connection

                if ($connection->connect_error) {
                    die("Connection Failed: ". $connection->connect_error);
                }

                $sql = "SELECT * FROM residents";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid Query: ". $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo"
                    <tr>
                        <td>$row[id]</td> 
                        <td>$row[last_name]</td> 
                        <td>$row[first_name]</td> 
                        <td>$row[member_4ps]</td> 
                        <td>$row[middle_name]</td> 
                        <td>$row[suffix]</td> 
                        <td>$row[sex]</td> 
                        <td>$row[birth_date]</td> 
                        <td>$row[birth_place]</td> 
                        <td>$row[age]</td> 
                        <td>$row[civil_status]</td> 
                        <td>$row[nationality]</td> 
                        <td>$row[religion]</td> 
                        <td>$row[occupation]</td> 
                        <td>$row[contact_number_general]</td> 
                        <td>$row[pwd]</td> 
                        <td>$row[pwd_id_no]</td> 
                        <td>$row[single_parent]</td> 
                        <td>$row[house_number]</td> 
                        <td>$row[purok_number]</td> 
                        <td>$row[street]</td> 
                        <td>$row[registered_voter]</td> 
                        <td>$row[voter_s_id_number]</td> 
                        <td>$row[tin_number]</td> 
                        <td>$row[national_id_number]</td> 
                        <td>$row[sss_number]</td> 
                        <td>$row[philhealth_no]</td> 
                        <td>$row[pagibig_no]</td> 
                        <td>$row[vaccinated]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='/accounts/edit.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/accounts/delete.php?id=$row[id]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>