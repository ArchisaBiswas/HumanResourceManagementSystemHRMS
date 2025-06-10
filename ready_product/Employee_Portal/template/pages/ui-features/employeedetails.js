/*
Team Number: 11

Team Members: Anshaj Ahuja (2141109)
              Archisa Biswas (2141145)
              Umaima Parveen Kakamari (2141162)

Web Technology Program: 4
*/


// Employee Dashboard --- Personal Details Page:


$(document).ready(function() 
{
    $.ajax
    ({
        url: "employeedetails.php",
        type: "GET",
        dataType: "text",
        success: function(data)
        {
            /*now = new Date();
            current_hour = now.getHours();
            current_minutes = now.getMinutes();

            if ((current_hour >= 0) && (current_hour < 12))
            {
                document.getElementById("greeting").innerHTML = "Good Morning, ";
            }
            else if ((current_hour == 12) && (current_minutes == 0))
            {
                document.getElementById("greeting").innerHTML = "Good Noon, ";
            }
            else if ((current_hour >= 12) && (current_hour <= 17))
            {
                document.getElementById("greeting").innerHTML = "Good Afternoon, ";
            }
            else if ((current_hour >= 18) && (current_hour <= 23))
            {
                document.getElementById("greeting").innerHTML = "Good Evening, ";
            }*/

            if (data.charAt(0) == "{")
            {
                response_data = JSON.parse(data);

                $("#name").text(response_data.information[0]["first_name"] + " " + response_data.information[0]["last_name"]);
                
                $("#employee_id").text(response_data.information[0]["employee_id"]);

                $("#phone_number").text("Phone Number: " + response_data.information[0]["ph_no"]);
                $("#home_number").text("Home Phone Number: " + response_data.information[0]["home_ph_no"]);

                $("#email_id").text("E-Mail ID: " + response_data.information[0]["email_id"]);

                $("#qualifications").text("Qualifications: " + response_data.information[0]["qualifications"]);
                $("#skills").text("Skills: " + response_data.information[0]["skills"]);

                $("#designation").text("Designation: " + response_data.information[0]["designation"]);
                $("#department").text("Department: " + response_data.information[0]["name"]);
                $("#manager").text("My Manager: " + response_data.manager[0]["first_name"] + " " + response_data.manager[0]["last_name"]);

                start_date = response_data.information[0]["start_date"];

                date_parts = start_date.split('-');
                formatted_start_date = date_parts[2] + '-' + date_parts[1] + '-' + date_parts[0];

                $("#start_date").text("Joining Date: " + formatted_start_date);

                date = new Date(start_date);

                experience_in_company = Math.round((Date.now() - date.getTime()) / 31536000000);

                $("#experience_in_company").text("Experience in this Company: " + experience_in_company.toString());

                $("#building_name").text(response_data.information[0]["building_name"]);
                $("#city").text(response_data.information[0]["city"]);
                $("#country").text(response_data.information[0]["country"]);
                $("#zipcode").text(response_data.information[0]["zipcode"]);

                date_of_birth = response_data.information[0]["date_of_birth"];

                date_parts = date_of_birth.split('-');
                formatted_date_of_birth = date_parts[2] + '-' + date_parts[1] + '-' + date_parts[0];

                $("#date_of_birth").text("Date of Birth: " + formatted_date_of_birth);
                $("#gender").text("Gender: " + response_data.information[0]["gender"]);
            }
            else
            {
                console.log(data);
            }
        }
    });
});