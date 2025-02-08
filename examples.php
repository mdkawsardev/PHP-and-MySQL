<?php 
// database connection 
$serverName = "localhost";
$userName   = "root";
$password   = "";
$dbName     = "practice";

// running query 
$conn = new mysqli($serverName, $userName, $password, $dbName);
if($conn->error) {
    die("Not connected!". $conn->error);
}


// inserted data into database 
$name    = null;
$email   = null;
$address = null;
if(isset($_POST['submit'])) {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $address = $_POST['address'];
    // running query to insert data into database 
    $insert_sql = "INSERT INTO info_table(name, email, address) VALUES('$name', '$email', '$address')";
    if($conn->query($insert_sql) === FALSE) {
        die("Failed". $insert_sql . $conn->error);
    }
}

// reading data into table using query 
$read_sql = "SELECT * FROM info_table";
$read_query = $conn->query($read_sql);

// delete all data 

if(isset($_GET['id'])) {
    $delete = $_GET['id'];
    $delete_sql = "DELETE FROM info_table WHERE id = $delete";
    if($conn->query($delete_sql) === TRUE) {
        header('location: index.php');
    }
}

// update all data 

if(isset($_GET['upid'])) {
    $upid = $_GET['upid'];
    $selectAllData = "SELECT * FROM info_table WHERE id = $upid";
    $runQuery = $conn->query($selectAllData);
    $allData = mysqli_fetch_assoc($runQuery);
    $selectId    = $allData['id'];    
    $selectName  = $allData['name'];
    $selectEmail = $allData['email'];
    $selectAdd   = $allData['address'];
}
if(isset($_POST['update'])) {
    $updateId    = $_POST['myid'];
    $updateName  = $_POST['name'];
    $updateEmail = $_POST['email'];
    $updateAdd   = $_POST['address'];
    
    // update query starts from here 
    $UpQuery = "UPDATE `info_table` SET `name`='$updateName',`email`='$updateEmail',`address`='$updateAdd' WHERE id=$updateId";
    if($conn->query($UpQuery) === TRUE) {
        header('location:index.php');
        
    } else {
        die("not inserted".$conn->error);
    }
}

// password generation 
$allKeys = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3',
'4','5','6','7','8','9','`','~','!','@','#','$','%','^','&','(',')','_','-','=','+',',','<','<','.','/','?');

$lenght = array(12,13,14);
shuffle($lenght);
$totalPass = $lenght[0];
$pass = null;
for($i = 0; $i <= $totalPass; $i++) {
    shuffle($allKeys);
    $pass .= $allKeys[0];
    
}
echo $pass;

// Object oriented PHP 
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo "Your name is: $name <br>";
    echo "Your email is: $email <br>";
    echo "Your password is: $password <br>";
}
    if(isset($_REQUEST['submit'])){
        $name = $_REQUEST['name'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        class data {
        public $username;
        public $useremail;
        public $password;
        function bioData($username, $useremail, $userpassword) {
            $this->username = $username;
            $this->useremail = $useremail;
            $this->password = $userpassword;
            return "Your name is:".$this->username."<br>"."Your email is:".$this->useremail."<br>"."Your password is:".sha1($this->password)."<br>";
        }
    }
    $allData = new data();
    echo $allData->bioData($name, $email, $password);
}

class fruit {
    protected $name;
    public $color;
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
}
$mango = new fruit();
$mango->set_name('mango');
$mango->color= 'green';
print_r($mango);
echo "<br>";
echo "Name:".$mango->get_name()."<br>";
echo "Color:".$mango->color."<br>";



class flower {
    public $name;
    public $color;
    function __construct($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
}
$rose = new flower('Rose');
echo $rose->get_name();


class human {
    public $work;
    public $sleep;
    public function __construct($work, $sleep) {
        $this->work = $work;
        $this->sleep = $sleep;
    }
    public function get_result() {
        return  "Hours of working:"." ".$this->work."<br>"."Hours of sleeping:"." ".$this->sleep;
    }
}
$humanbeing = new human('8 hours', '7 hours');
echo $humanbeing->get_result();
echo "<br>";

class animal extends human {
    public function newMessage(){
        return "This is animal part.";
    }
}
$kawsar = new animal('20', '21');
echo $kawsar->get_result()."<br>";
echo $kawsar->newMessage();
echo "<br>";
echo $kawsar->work."<br>";
echo $kawsar->sleep;

?>