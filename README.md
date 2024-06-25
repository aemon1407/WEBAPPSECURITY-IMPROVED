# WEBAPPSECURITY-IMPROVED
# Final Assessment INFO 4345

# Group Name
## Razer
# Group Member
|Member                      |Matric ID| Assigned Tasks
|----------------------------|---------|---------
|Aiman Fathi Bin Mohd Fairuz |2121549  | Regex application, input validation, authentication of admin login, application of session and timeout, authorization for admin access, password hashing
|Safwan bin Roslin           |2113779  |
|Muhammad Haniff bin Ismail  |2110619  |

## Brief Description
Web application development is not just about applying business logic and automation of a business flow. It is more on providing a secure service to its users and ensure its availability when it is needed. In any web application development, the most common concerns are input validation, authentication, authorization, XSS and CSRF prevention, and enforcing database and file securities. Thus, for web application security group project we are required to enhance our previous web application development from Web Technologies (INFO 2302) and apply all the security elements or components that we have learned in class to ensure the previous developed web application is hardened with the required security elements or components. 

## Title
PEMBINA IIUM

## Introduction

## Objective of the Enchancements

## Web Application Security Enhancements
### 1. Input Validation
Implemented input validation to prevent unwanted characters or format for every user input.
- Using Regex, to ensure that only allowed characters can be entered as input.
  Snippets from Registration.php :
  async function validateInputs() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const matricno = document.getElementById('matricno').value;
    const password = document.getElementById('password').value;
    const password2 = document.getElementById('password2').value;


    const usernameRegex = /^[a-zA-Z\s]+$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const matricnoRegex = /^\d+$/;
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


    if (!usernameRegex.test(username)) {
        alert('Name must contain only letters and spaces.');
        return false;
    }
- 
### 2. Authentication
### 3. Authorization
### 4. CSS
### 5. CSRF Prevention
### 6. Database Security Principles
### 7. File Security Principles
### 8. Additional Security Measure
