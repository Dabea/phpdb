<!DOCTYPE html>
<html>
<head>
    <title>Event Schedule</title> 
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
</head>
<body>
    <div class="container">
    <!-- header -->
   
    <h1 class="text-center">Event Schedule Sign Up Sheet</h1>
    
    <!-- Form -->
    <form action="" method="post" class="well  form-horizontal col-xs-12"> 
        <h1 class="text-center">Event Schedule Sign Up Sheet</h1>
        <div class="form-group col-xs-6 ">
            <label for="signup_name" class="control-label col-xs-2">Name</label>
            <div class="col-xs-10"> 
                <input type="text" class="form-control" id="signup_name" name="name" placeholder="Enter Name" />
            </div>
        </div>
        <div class="form-group col-xs-6">
            <label for="signup_class" class=" control-label col-xs-2">Class</label>
            <div class="col-xs-10 ">  
                <select name="class" class="form-control">
                    <option value="Archer">Archer </option>
                    <option value="Bezerker">Berzerker </option>
                    <option value="Lancer">Lancer </option>
                    <option value="Mystic">Mystic </option>
                    <option value="Preist">Preist </option>
                     <option value="Reaper">Reaper </option>
                    <option value="Slayer">Slayer</option>
                    <option value="Warrior">Warrior </option>
                </select> <!--<input type="text" class="form-control" id="signup_class" name="class" placeholder="Enter Class" /></div> -->
            </div>    
        </div>
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        </div>  
        
         <?php
    include 'login.php';
        // This creates the mysqli object and connection
    $dbconnect = new mysqli("$host","$username","$password","$database");
        if(mysqli_connect_error()){
            echo "failed to connect" . mysqli_connect_error();
        }
        else{
            echo "connection sussfull";
        }
?>

    </form>
    <div class="col-xs-3"></div>
    <!-- Out Put -->
    
    
    <h1>this is the output</h1>
    <?php
        $inpututname = $_POST['name'];
        $inputclass = $_POST['class'];
        // This is the SQL to check if there is already a user
        $check = "SELECT id FROM signup 
        WHERE name=?";
        //This runs the sql query to check for users and saves it for later use
        $checkout = mysqli_query($dbconnect, $check);
        //these prepare and set up the data to sanitise data
        $stmt = $dbconnect->prepare($check);
        $stmt->bind_param('s', $_POST['name']);
        $stmt->execute();
        
        if(isset($_POST['submit'])){
            $testName = $_POST['name'];
            $testClass = $_POST['class'];
            
            // This makes sure there is input from both fields
            if ($_POST['name'] != null && $_POST['class'] != null ){
                //If there is an entry that matches a name in the Db there will be something in the fetch results
                if($stmt->fetch()){
                    echo  $testName . " is allready Singed up" . "<br/>";
                    $testName = null;
                    $testclass = null; 
                }
                else{
                echo "added";
                // New SQL Query to add data in the DB
                $addquery = "INSERT INTO signup (name, class)
                VALUES (?, ?)";
                //these prepare and set up the data to sanitise data
                $stmtadd = $dbconnect->prepare($addquery);
                $stmtadd->bind_param('ss',$_POST['name'],$_POST['class']);
                $stmtadd->execute();
                //closes the connection
                mysqli_close($dbconnect);
                //resets the feilds to empty
                $testName = null;
                $testclass = null; 
                 
                }
                   
                    
            }
            
        }
        //This displays the info in the DB in a tabel
        //Opens the connection
        $dbconnect2 = mysqli_connect("$host","$username","$password","$database");
        //makes the connection
        $query = "SELECT * FROM signup";
        $result = mysqli_query($dbconnect2, $query);
        //checks  for an error on the connection
        if(mysqli_errno()){
            echo "The error is " . mysqli_error();
        }
        // sets up the HTML front part of the table for the DB data
        echo " <div class='col-xs-4'><table class=' table table-bordered table-hover'>
        <tr>
            <th>Name</th>
            <th>Class</th>
        </tr>    
        ";
        //the code that displays the data from the Db and also sets it in the table with HTML tags
        while($row = mysqli_fetch_array($result)){
            echo "<tr> <td>". $row['name'] . "</td>   <td>"  . $row['class'] . "</td> </tr>";
        }
        echo "</table> </div>";
    
    ?>
    </div>
    
</body>

</html>
