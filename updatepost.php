<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<?php

class update{

protected $sql = "SELECT * FROM `update` ORDER BY date DESC";
protected $pretable = " <div class='col-xs-4'><table class=' table table-bordered table-hover'><tr><th>head</th><th>body</th></tr>";
protected $posttable = "</table> </div>";



    public function posts(){
        include 'login.php';
        
        

        $con = new mysqli($host,$username,$password,$database);
            if($con->connect_error){
                echo "Could not connect" . $con->connect_error;
            }
            else{
                echo "connection sussfull";
            }
        $resluts = $con->query($this->sql);
         echo $this->pretable;
        while($row = $resluts->fetch_array() ){
            
            echo "<div class='media' >
                            <div class='pull-left'>
                                <img class='media-object avatar' src='http://placekitten.com/g/100/110' />
                            </div>
                            <div class='media-body'>
                                <span class='media-headinia-body heading '> <h3>" . $row['head']  ." </h3></span>
                                <span class='postby'>posted by" . $row['author'] . $row['date'] . "</span>
                            </div>
                        <p> " . $row['body'] . "</p>
                        <p></p>
                    </div>";

        }
        echo $this->posttable;
    }
}
$test= new update();
$test->posts();

?>
