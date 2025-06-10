var apply = document.getElementById("apply");

apply.addEventListener("click", function(event) {
  event.preventDefault(); 
  compute_number_of_days();
});

var submit = document.getElementById("submit");

submit.addEventListener("click", function(event) {
  event.preventDefault();
  fetchData();
});

var yes_take = document.getElementById("yes_take");

yes_take.addEventListener("click", function(event) {
  event.preventDefault();
  updateLeavesTaken();
});

var number_of_days;

function compute_number_of_days()
{
    console.log("in");
    from = document.getElementById("from_date").value;
    to = document.getElementById("to_date").value;

    var from_date = new Date(from);
    var to_date = new Date(to);

    var difference_In_Time = to_date.getTime() - from_date.getTime();

    number_of_days = difference_In_Time / (1000 * 3600 * 24);

    document.getElementById("confirmation").style.visibility = "visible";
    document.getElementById("confirmation").innerHTML = "Confirm Application of leave from " + from + 
                                                        " to " + to + " for ";
    
    document.getElementById("number_of_days").style.visibility = "visible";
    document.getElementById("number_of_days").innerHTML = number_of_days;

    document.getElementById("confirmation_second_half").style.visibility = "visible";
    document.getElementById("confirmation_second_half").innerHTML = " Number of Days?";
    
    document.getElementById("submit").style.visibility = "visible";
    document.getElementById("no").style.visibility = "visible";
}

function updateLeavesTaken()
{
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() 
    {
        if (xhttp.readyState == 4 && xhttp.status == 200) 
        {
            console.log(xhttp.responseText);

            if (xhttp.responseText.charAt(xhttp.responseText.length - 1) == "1")
            {
                document.getElementById("final_result").style.visibility = "visible";
                document.getElementById("final_result").innerHTML = "Leave Application Successfully Processed. Thank you.";
            }
            else
            {
                document.getElementById("final_result").style.visibility = "visible";
                document.getElementById("final_result").innerHTML = "Leave Application Unsuccessfully Processed. Please try again.";
            }
        }
    };

    xhttp.open("GET", "leave_entitlement.php?function=updateLeaves&number_of_days=" + encodeURIComponent(number_of_days), true);
    xhttp.send();
}

function fetchData() 
{
    var xhttp = new XMLHttpRequest();

    var url = "leave_entitlement.php?number_of_days=" + encodeURIComponent(number_of_days);
    xhttp.open("GET", url, true);
    xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() 
    {
        if (xhttp.readyState == 4 && xhttp.status == 200) 
        {
            // Handle the response from the server
            console.log(xhttp.responseText);

            var response = xhttp.responseText;

            if (response != "Granted")
            {
                document.getElementById('result').style.visibility = "visible";
                document.getElementById('result').innerHTML = response;

                document.getElementById('yes_take').style.visibility = "visible";
                document.getElementById('no_take').style.visibility = "visible";
            }
            else
            {
                document.getElementById('result').style.visibility = "visible";
                document.getElementById('result').innerHTML = response;

                updateLeavesTaken();
            }
        }
    };

    xhttp.send();
}