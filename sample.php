<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Import Excel To MySQL Database Using PHP </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Import Excel File To MySQL Database Using php">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="css/bootstrap-custom.css">


</head>

<body>

    <!-- Navbar
    ================================================== -->

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Import Excel To MySQL Database Using PHP</a>

            </div>
        </div>
    </div>

    <div id="wrap">
        <div class="container">
            <div class="row">
                <div class="span3 hidden-phone"></div>
                <div class="span6" id="form-login">
                    <form class="form-horizontal well" action="sample.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Import CSV/Excel file</legend>
                            <div class="control-group">
                                <div class="control-label">
                                    <label>CSV/Excel File:</label>
                                </div>
                                <div class="controls">
                                    <input type="file" name="file" id="file" class="input-large">
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="span3 hidden-phone"></div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Unit</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <?php
                $conn = mysqli_connect("localhost", "root", "") or die("Could not connect");
                mysqli_select_db($conn, "uiiDb") or die("could not connect database");
                if (isset($_POST["Import"])) {
                    echo $filename = $_FILES["file"]["tmp_name"];
                    if ($_FILES["file"]["size"] > 0) {
                        //initial values to local variables
                        $table = "intoreIdentities";
                        $file = fopen($filename, "r");
                        $fieldNames = array();
                        $fieldValues = array();
                        $caughtEmptyFields = array();
                        $bindsSet = array();
                        $topRowPointer = true;
                        $firstColumnIsIdentifier = true;

                        //fetch and sort data from the csv file
                        while (($emapData = fgetcsv($file, 100000, ",")) !== FALSE) {
                            if ($topRowPointer) {
                                // select the header
                                for ($i = 0; $i < count($emapData); $i++) {
                                    if ($emapData[$i] != "" && $emapData[$i] != null) {
                                        array_push($fieldNames, $emapData[$i]);
                                    }
                                }
                                //change the header pointer
                                $topRowPointer = false;
                                continue;
                            }
                            // insert normal data to the values array
                            array_push($fieldValues, $emapData);
                        }
                        //closes the file
                        fclose($file);

                        //creates insertFields query
                        $fields = "";
                        for ($i = 0; $i < count($fieldNames); $i++) {
                            if($firstColumnIsIdentifier && $i == 0){
                                continue;
                            }
                            $fields .= $fieldNames[$i] . ", ";
                        }
                        $fields = rtrim($fields, ", ");
                        $insertFields = $table . "( " . $fields . " )";

                        //get all cells, creates, insertValues string, and append name_values them to binds array
                        $insertValues = "";
                        for ($j = 0; $j < count($fieldValues); $j++) {
                            //checks whether the first column is for id
                            $firstColumnIsIdentifier = is_numeric(number_format($fieldValues[0][0]));
                            $valueNames = "";
                            //loops through the data rows and creates query parts
                            for ($i = 0; $i < count($fieldNames); $i++) {
                                if($firstColumnIsIdentifier && $i == 0){
                                    continue;
                                }
                                $cellValue = $fieldValues[$j][$i];
                                $cellName = "R" . strval($j) . "C" . strval($i);
                                //throw message for empty cells
                                if (!($cellValue != "" && $cellValue != null)) {
                                    array_push($caughtEmptyFields, ["position" => '$fieldValues[' . $j . '][' . $i . '] is empty or null', "fieldName" => $fieldNames[$i]]);
                                }
                                //create value name, adds to the query, and save to the binds array
                                $valueNames .= '"'.$cellValue . '", ';
                                $bindsSet[$cellName] = $cellValue;
                            }
                            $valueNames = rtrim($valueNames, ", ");
                            $insertValues .= "( " . $valueNames . " ), ";
                        }
                        $insertValues = rtrim($insertValues, ", ");

                        // creates the database query
                        $query = "INSERT INTO " . $insertFields . " VALUES " . $insertValues;
                        // prepares the query
                        if (mysqli_multi_query($conn,  $query)) {
                            echo "New records created successfully";
                        } else {
                            echo "Error: " . $query . "<br>" . mysqli_error($conn);
                        }
                        mysqli_close($conn);
                    }
                }
                ?>
            </table>
        </div>

    </div>

</body>

</html>