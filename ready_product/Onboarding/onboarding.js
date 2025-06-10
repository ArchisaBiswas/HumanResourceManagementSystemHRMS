/*
    Team Number: 11

    Team Members: Anshaj Ahuja (2141109)
                  Archisa Biswas (2141145)
                  Umaima Parveen Kakamari (2141162)

    Web Technology Program: 6
*/


// Demonstration of Document Object Model (DOM):

function validate()
          {
            var valid = true;

            var userformat=/^[A-Za-z][A-Za-z0-9_]{7,29}$/;
              var username=document.getElementById('login').value;
              
              if(username=="" || userformat.test(username))
              {
                  window.alert('Please enter valid first name.');
                  document.getElementById('login').focus();
                  return false;
              }
              var regName = /^[a-zA-Z]+ [a-zA-Z]+$/;
              var fname = document.getElementsByClassName('fname').value;
              if(fname=="" || regName.test(fname)){
                  window.alert('Please enter valid first name.');
                  document.getElementById('fname').focus();
                  return false;
              }
              var lastformat=/^[a-zA-Z]+ [a-zA-Z]+$/;
              var lname=document.getElementById('lname').value;
              if(lname=="" || lastformat.test(lname)){
                  alert('Please enter valid last name.');
                  document.getElementById('lname').focus();
                  return false;
              }
              var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
              var email=document.getElementById('email').value;
              if(!mailformat.test(email))
              {
                  alert("Please enter valid email address!");
                  document.getElementById('email').focus();
                  return false;
              }
              var phoneformat=/^[0-9]\d{2,4}-\d{6,8}$/;
              var phno=document.getElementById('phno').value;
              if(phno=="" || phoneformat.test(phno))
              {
                  alert("Please enter valid phone number!");
                  document.getElementById('phno').focus();
                  return false;
              }
              var homeformat=/^[0-9]\d{2,4}-\d{6,8}$/;
              var homeno=document.getElementById('homeno').value;
              if(homeno=="" || homeformat.test(homeno))
              {
                  alert("Please enter valid home/landline number!");
                  document.getElementById('homeno').focus();
                  return false;
              }
              var dateformat=/^(0?[1-9]|1[0-2])[\/](0?[1-9]|[1-2][0-9]|3[01])[\/]\d{4}$/;
              var startdate=document.getElementById('startdate').value;
              if(startdate=="" || dateformat.test(startdate))
              {
                  alert("Please enter valid start date!");
                  document.getElementById('startdate').focus();
                  return false;
              }
              var expformat=/^\d{2}$/;
              var exp1=document.getElementById('experience').value;
              if(exp1=="" || expformat.test(exp1))
              {
                  alert("Please enter valid experience!");
                  document.getElementById('experience').focus();
                  return false;
              }
            var dobformat=/^(0?[1-9]|1[0-2])[\/](0?[1-9]|[1-2][0-9]|3[01])[\/]\d{4}$/;
            var dateofbirth=document.getElementById('dob').value;
            if(dateofbirth=="" || dobformat.test(dateofbirth))
            {
                alert("Please enter valid date of birth!");
                document.getElementById('dob').focus();
                return false;
            } 
            var buildingformat=/^[A-Z][a-z]+\s?$/;
            var building=document.getElementById('building_name').value;
            if(building=="" || buildingformat.test(building))
              {
                  alert("Please enter valid building name!");
                  document.getElementById('building_name').focus();
                  return false;
              }
              var cityformat=/^[A-Z][a-z]+\s?$/;
              var city=document.getElementById('city').value;
              if(city=="" || cityformat.test(city) == false)
              {
                  alert("Please enter valid city!");
                  document.getElementById('city').focus();
                  return false;
              }
              var countryformat=/^[A-Z][a-z]+\s?$/;
              /*countryformat = "India";
              var country=document.getElementById('country').value;
              if(country=="" || countryformat.test(country))
              {
                  valid = false;
                  message(valid);
                  alert("Please enter valid country!");
                  document.getElementById('country').focus();
                  return false;
              }*/
              var zipformat=/^[1-9]{1}[0-9]{2}\\s{0, 1}[0-9]{3}$/;
              var zipcode=document.getElementById('zipcode').value;
              if(zipcode=="" || zipformat.test(zipcode))
              {
                  alert("Please enter valid zip code!");
                  document.getElementById('zipcode').focus();
                  return false;
              }
              var genderformat=/"^M(ale)?$|^F(emale)?$"/;
              var gender=document.getElementById('gender').value;
              if(gender=="" || genderformat.test(gender))
              {
                  alert("Please enter valid gender!");
                  document.getElementById('gender').focus();
                  return false;
              }
              var passformat=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
              var password=document.getElementById('password').value;
              if(password=="" || passformat.test(password))
              {
                  alert("Please enter valid password!");
                  document.getElementById('password').focus();
                  return false;
              }
              var firstpassword=document.getElementById('password').value;
              var secondpassword=document.getElementById('password2').value;
              if(secondpassword=="" || (secondpassword !== firstpassword) )
              {
                    alert("Re-entered password is invalid!");
                    document.getElementById('password2').focus();
                    return false;
              }
          }

form = document.getElementById('form');

form.addEventListener('submit', function(event) 
{
    event.preventDefault();

    username = document.getElementById('username').value;
    email = document.getElementById('email').value;
    dob = document.getElementById('dob').value;
    gender = document.getElementById('gender').value;
    fname = document.getElementById('fname').value;
    lname = document.getElementById('lname').value;
    phno = document.getElementById('phno').value;
    homeno = document.getElementById('homeno').value;
    startdate = document.getElementById('startdate').value;
    role = document.getElementById('role').value;
    qualifications = document.getElementById('qualifications').value;
    skills = document.getElementById('skills').value;
    building_name = document.getElementById('building_name').value;
    city = document.getElementById('city').value;
    country = document.getElementById('country').value;
    zipcode = document.getElementById('zipcode').value;
    department = document.getElementById('department').value;
    designation = document.getElementById('designation').value;
    manager_fname = document.getElementById('manager_fname').value;
    manager_lname = document.getElementById('manager_lname').value;
    password = document.getElementById('password2').value;

    xhr = new XMLHttpRequest();

    xhr.open('POST', 'onboarding.php', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() 
    {
        if (this.status === 200) 
        {
            console.log(this.responseText);
        }
        else
        {
            console.log("Error: " + this.responseText);
        }
    };

    xhr.send(`username=${username}&email=${email}&dob=${dob}&gender=${gender}&fname=${fname}&lname=${lname}
              &phno=${phno}&homeno=${homeno}&startdate=${startdate}&role=${role}
              &qualifications=${qualifications}&skills=${skills}&building_name=${building_name}
              &city=${city}&country=${country}&zipcode=${zipcode}&department=${department}
              &designation=${designation}&manager_fname=${manager_fname}&manager_lname=${manager_lname}
              &password=${password}`);
});