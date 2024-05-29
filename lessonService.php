<?php 
require 'includes/database.php';
require 'includes/validate.php';

session_start();


switch($_POST["functionname"])
{
    case 'BookLesson':
        BookLesson();
        break;
    case 'Cancel':
        Cancel();
        break;
        case 'Update':
            Update();
            break;
            case 'AttendLesson':
                AttendLesson();
                break;   
                case 'SubmitFeedback':
                    SubmitFeedback();
                    break;   
                    case 'SignUp':
                        SignUp();
                        break;
}

function BookLesson(){

$conn=getDB();

$lessonId=$_POST['lessonId'];
$cutomerId=$_POST['customerId'];

echo $lessonId;
echo $cutomerId;

$check="SELECT * FROM `booked_lesson` WHERE FL_TT_ID=$lessonId AND C_ID=$cutomerId AND Status='Booked'";

$result=$conn->query($check);

if($result->num_rows > 0){
    echo "Booking already exist. please try another record.";
    exit();
  }
else{
    $sql="INSERT INTO `booked_lesson` (`Id`, `FL_TT_ID`, `C_ID`, `Status`) VALUES (NULL, $lessonId , $cutomerId , 'Booked');";
    $result=$conn->query($sql);
    if($result===true){
        echo "Lesson booked successfully";
    }else{
        echo "Failed to save record";
    }
}
$conn->close();
}

function Cancel(){
    $conn=getDB();

    $lessonId=$_POST['lessonId'];
    $cutomerId=$_POST['customerId'];

    $check="SELECT * FROM `booked_lesson` WHERE FL_TT_ID=$lessonId AND C_ID=$cutomerId AND Status='Cancelled'";
    
    $result=$conn->query($check);

    
if($result->num_rows > 0){
    echo "Lesson alraedy cancelled. please try another record.";
    exit();
  }else{
    $sql="UPDATE booked_lesson SET STATUS='Cancelled' WHERE FL_TT_ID=$lessonId AND C_ID=$cutomerId";
    $result=$conn->query($sql);
    if($result===true){
        echo "Lesson cancelled successfully";
    }else{  
        echo "Failed to cancel record";
    }
  }
  $conn->close();
}

function Update(){
    $conn=getDB();

    $lessonId=$_POST['lessonId'];
    $bookingId=$_POST['bookingId'];

    $check="SELECT * FROM booked_lesson WHERE STATUS='Cancel' ||  STATUS='Changed'  AND Id=$bookingId";
    
    $result=$conn->query($check);
    
    if($result->num_rows > 0){
        echo "Lesson is already cancelled or changed. please try another record.";
        exit();
      }
    else{
        $sql="UPDATE booked_lesson SET FL_TT_ID=$lessonId, STATUS='Changed' WHERE Id=$bookingId";
        $result=$conn->query($sql);
        if($result===true){
            echo "Lesson changed successfully.";
        }else{
            echo "Failed to change record";
        }
    }
}


function AttendLesson() {
    $conn = getDB();
    $bookingId = isset($_POST['bookingId']) ? $_POST['bookingId'] : null;

    if (!$bookingId) {
        echo "Booking ID is not provided.";
        exit();
    }

    $check = "SELECT Status FROM booked_lesson WHERE Id = $bookingId LIMIT 1";
    $result = $conn->query($check);

    if ($result) {
        $data = $result->fetch_assoc();

        if (!$data) {
            echo "No data found for the provided Booking ID.";
        } else {
            $status = isset($data["Status"]) ? $data["Status"] : null;

            if ($status == "Cancelled" || $status == "Attended") {
                echo "Lesson is already cancelled or changed or attended. Please try another record.";
            } else {
                $sql = "UPDATE booked_lesson SET STATUS='Attended' WHERE Id = $bookingId";
                $updateResult = $conn->query($sql);

                if ($updateResult) {
                    echo "Lesson attended successfully.";
                } else {
                    echo "Failed to attend lesson. Error: " . $conn->error;
                }
            }
        }
    } else {
        echo "Error executing query. Error: " . $conn->error;
    }
}



    function SubmitFeedback(){
        $conn=getDB();
        $comments=$_POST['comments'];
        $rating=$_POST['rating'];
        $bookingId=$_POST['bookingId'];
    
        $sql="INSERT INTO customer_review(R_ID, B_ID, Comment) VALUES ('$rating' , '$bookingId' , '$comments')";
    
        $result=$conn->query($sql);
        if($result===true){
            echo "Review saved successfully";
        }else{
            echo "Failed to save review";
        }
    }

    function SignUp() {
        $conn = getDB();
    
        $fname = $_POST['fname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPass = $_POST['confirmPassword'];
    
        if (!validateEmail($email)) {
            echo "Invalid email";
        } elseif (empty($fname) || empty($address) || empty($email) || empty($password) || empty($confirmPass)) {
            echo 'One or more fields are empty';
        } elseif (!empty(getUser($conn, $email))) {
            echo "User already exists";
        } elseif ($password != $confirmPass) {
            echo 'Passwords do not match';
        } else {
            $sql = "INSERT INTO customer (Username, Address, FullName, Password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
    
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $email, $address, $fname, $password);
    
                if (mysqli_stmt_execute($stmt)) {
                    echo "Sign Up is successful";
                } else {
                    echo "Error executing statement: " . mysqli_stmt_error($stmt);
                }
            } else {
                echo "Error preparing statement: " . mysqli_error($conn);
            }
        }
    }
    

?>