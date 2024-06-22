var memberArray = []; //Array for the object
var idCounter = 1; //use to generate ID Number


form.addEventListener('submit', e => { //when the form submit button is click this will happen
    e.preventDefault();
    //First,it will validate the input from user.
    //if validateInputs()==false, this function cannot be executed
    if(validateInputs()){   //validateinput()==true, the input data will be store to the member object
        var Member = {   
            id: generateID(), //function to generate unique sequential id
            name: document.getElementById('username').value,
            matricno: document.getElementById('matricno').value,
            bureau: document.getElementById('beruea').value

        };

        memberArray.push(Member); //the object will be store to array with starting index[0]
        console.log(memberArray); //to check thus the object be stored to array
        alert('Congrats, you are now PEMBINA members with id: '+ Member.id);//alert message pop up and give id to the members
        document.getElementById('form').reset();//reset the form so another user can sign up
        
    }
});

//When we validate, the input and get error, they will pass the input and message to this function, then this fuction 
//will turn the box form to red and 
//display the message, if the user has got correct before and they make change and error, it will change the green to red and display the message


const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
};
//When we validate, the input is right, they will pass the input to this function, then this function will change the box form to green.
//If the user put wrong input before and change it to the right input, this function will remove the red display and message and display the box form in green
const setSuccess = (element) => { 
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());//function to check the validity of email
};

const validateInputs = () => {
    const usernameValue = document.getElementById('username').value.trim();    //we select element from the page DOM and assign to the variable
    const emailValue = document.getElementById('email').value.trim();           
    const passwordValue = document.getElementById('password').value.trim();
    const password2Value = document.getElementById('password2').value.trim();
    const matricnoValue = document.getElementById('matricno').value.trim();
    const berueaValue = document.getElementById('beruea').value;
   

    if(usernameValue === '') {
        //set the errormessages
        setError(username, 'this field must not be blank');
        return false;   //return boolean value of false to the function validateinput()
        
    } else if(usernameValue.length < 4){
        setError(username, 'username must have more than 4 characters '); //username must have more than 4 character
       return false;
    }
    else {
        setSuccess(username); //valid input
        
    }

    if(emailValue === '') {
        setError(email, 'this field must not be blank'); //input field cannot be blank
        return false; //return boolean value of false to the function validateinput()
    } else if (!isValidEmail(emailValue)) { //input sent to the isvalidemail function, if not follow the rule seterror will be triggered
        setError(email, 'email must be in appropriate format');
        return false;
    } else {
        setSuccess(email);//valid input
        
    }

    if(matricnoValue=== ''){
        setError(matricno, 'this field must not be blank'); 
        return false; //return boolean value of false to the function validateinput()
    }
    else if(matricnoValue.length < 6){
        setError(matricno, 'matricno must have more than 6'); 
        return false;
    }
    else if(isNaN(matricnoValue)){ //function is NaN is used to check whether input is not a number
        setError(matricno, 'matricno be a number');
       return false;
    }
    else{
        setSuccess(matricno);
        
    }

    if(passwordValue === '') {
        setError(password, 'this field must not be blank');
        return false;
    } else if (passwordValue.length < 8 ) {
        setError(password, 'password must have more than 8 characters');
        return false;
    } else {
        setSuccess(password);
        
    }

    if(password2Value === '') {
        setError(password2, 'this field must not be blank');
        return false;
    } else if (password2Value !== passwordValue) {
        setError(password2, 'password not same');//password must be same with the password input
        return false;
    } else {
        setSuccess(password2);
        
    }

    if(document.getElementById('yes').checked == true){  //if user tick yes but do not choose bureau it will send error message
        if (berueaValue == 'no-beruea'){                    //to choose the bureau
            setError(beruea, 'please choose your beruea');
            return false;
        }
        else{
            setSuccess(beruea);
            
        }
    }
    else if(document.getElementById('no').checked == true){ //if user tick no but choose bureau, it will send error message to tick yes in the selection
        if (berueaValue != 'no-beruea' ){
            setError(beruea, 'please tick yes');
            return false;
        }
        else {
            setSuccess(beruea);
            
        }   
        
    }
   
        
   return true;//validateinput()==true
   
  
};

function generateID() {
    var id = String(idCounter).padStart(3, '0'); // Pad with leading zeros
    idCounter++; // Increment ID counter for the next submission
    return id;
  }
//search function
form1.addEventListener('submit', e => {   //when search button is click,this will happen
    e.preventDefault();
    searchData = document.getElementById('searching').value.trim(); //select element DOM
    var foundIndex = findIndexByName(searchData); //function to get the index of array of the search data
    //display part
    var table = document.getElementById("memberlist"); //select table DOM
    while (table.firstChild) {     
    table.removeChild(table.firstChild); //remove the table for new search
    }

    if (foundIndex.length > 0) {

        var headerRow = document.createElement("tr"); //create table row
        var headers = ["ID", "Name", "Matricno", "Bureau"]; //header for table
    headers.forEach(function(headerText) {
        var headerCell = document.createElement("th"); //create table header
        headerCell.textContent = headerText; //put inside the table header the headers,ID,NAME,MATRICNO,BUREAU
        headerRow.appendChild(headerCell);//add table header inside table row
    });
        table.appendChild(headerRow);//put the table row and table header inside the table

        console.log("Name found at indices:", foundIndex); //console to check whether the search is success or not
        foundIndex.forEach(function(index) {
        console.log("Form Data at index", index, ":", memberArray[index]);
        var rowData = memberArray[index];
        var row = document.createElement("tr"); //create table row
        Object.values(rowData).forEach(function(value) { //display all the data that in the object that we want to search in table
          var cell = document.createElement("td");
          cell.textContent = value;
          row.appendChild(cell);
        });
        table.appendChild(row);
        });
    } 
    else { //if the input search does not match the data,it will alert the user data not found
    console.log("Name not found");
     alert('Data not found');
    }

});

function findIndexByName(name) { 
    for (var i = 0; i < memberArray.length; i++) {
        var indices = []; //this function will check whether the input search is match with the data in the array object,
        for (var i = 0; i < memberArray.length; i++) {  
          if (memberArray[i].bureau.toLowerCase() === name) {
            indices.push(i); // Add index to the array if name matches
          }
          else if(memberArray[i].name.toLowerCase() === name){
            indices.push(i);  //tolowercase because in the HTML we ask the user to search in lowercase
          }
          else if(memberArray[i].matricno === name){
            indices.push(i);
          }
          else if(memberArray[i].id === name){
            indices.push(i);
          }

        }
        return indices; // Return array of indices, it will return all the index that match the search, not the first one only
      }
  }

