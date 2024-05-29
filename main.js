
function BookMe(lessonId, customerId) {
    console.log("lessonId: " + lessonId + " | CustomerId: " + customerId);
    jQuery.ajax({
        type: "POST",
        url: 'LessonService.php',
        data: { functionname: 'BookLesson', lessonId: lessonId, customerId: customerId },
        success: function (data) {
            alert(data);
            console.log(data);
        }
    });
}
function Cancel(lessonId, customerId) {
    console.log("lessonId: " + lessonId + " | CustomerId: " + customerId);
    jQuery.ajax({
        type: "POST",
        url: 'LessonService.php',
        data: { functionname: 'Cancel', lessonId: lessonId, customerId: customerId },
        success: function (data) {
            alert(data);
            console.log(data);
        }
    });
}

function Update(bookingId) {
    let text;
    let lessonId = prompt("Please enter available lesson Id:", "");
    debugger;
    if (lessonId != null && lessonId != "") {

        text = "User selected: " + bookingId;

        jQuery.ajax({
            type: "POST",
            url: 'LessonService.php',
            data: { functionname: 'Update', lessonId: lessonId, bookingId: bookingId },
            success: function (data) {
                alert(data);
                console.log(data);
            }
        });

    } else {
        text = "User cancelled the prompt.";
    }
    console.log(text);
}


function Attend() {
    var bookingId = $("#BookingId").val();

    if (typeof bookingId === "undefined" || bookingId === "") {
        alert("Please enter Booking ID.");
    } else {
        jQuery.ajax({
            type: "POST",
            url: 'LessonService.php',
            data: { functionname: 'AttendLesson', bookingId: bookingId },
            success: function (data) {
                alert(data);
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}


function submitFeedback() {
    var bookingId = $("#BookingId").val();
    var comments = $("#FeedbackId").val();
    var rating = $("#RatingId").val();

    console.log("BookingId: " + bookingId + " | rating: " + rating + "  " + " comments: " + comments);

    if (typeof (comments) === "undefined" || comments === "" || typeof (rating) === "undefined" || rating === "" || typeof (bookingId) === "undefined" || bookingId === "") {
        alert(" Comments or rating or bookingId are empty.");
    } else {
        jQuery.ajax({
            type: "POST",
            url: 'LessonService.php',
            data: { functionname: 'SubmitFeedback', comments: comments, rating: rating, bookingId: bookingId },
            success: function (data) {
                alert(data);
                console.log(data);
            }
        });
    }
}


function SignUp() {
    var fname = $("#fname").val();
    var address = $("#address").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();

    if (fname === "" || address === "" || email === "" || password === "" || confirmPassword === "") {
        alert("One or more fields are empty.");
    } else {
        $.ajax({
            type: "POST",
            url: 'LessonService.php',
            data: { functionname: 'SignUp', fname: fname, address: address, email: email, password: password, confirmPassword: confirmPassword },
            success: function (data) {
                alert(data);
                if (data === "Sign Up is successful") {
                    window.location.href = "userlogin.php";
                }
                console.log(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
                console.log(textStatus, errorThrown);
            }
        });
    }
}



function getGoogleMap(){
    var mapProp= {
        center:new google.maps.LatLng(51.508742,-0.120850),
        zoom:5,
      };
      var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
      
}