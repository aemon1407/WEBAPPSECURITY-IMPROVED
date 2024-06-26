# WEBAPPSECURITY-IMPROVED
# Final Assessment INFO 4345 | RAZER

## Group Member
|Member                      |Matric ID| Assigned Tasks
|----------------------------|---------|---------
|Aiman Fathi Bin Mohd Fairuz |2121549  | Regex application, input validation, authentication of admin login, application of session and timeout, authorization for admin access, password hashing
|Safwan bin Roslin           |2113779  |
|Muhammad Haniff bin Ismail  |2110619  |

## Table of Content
[1]: InputValidation


## Brief Description
Web application development is not just about applying business logic and automation of a business flow. It is more on providing a secure service to its users and ensure its availability when it is needed. In any web application development, the most common concerns are input validation, authentication, authorization, XSS and CSRF prevention, and enforcing database and file securities. Thus, for web application security group project we are required to enhance our previous web application development from Web Technologies (INFO 2302) and apply all the security elements or components that we have learned in class to ensure the previous developed web application is hardened with the required security elements or components. 

## Title
PEMBINA IIUM

## Introduction

## Objective of the Enchancements

## Web Application Security Enhancements
### 1. Input Validation [1]
Implemented input validation to prevent unwanted characters or format for every user input.
- Using Regex, to ensure that only allowed characters can be entered as input.
  Snippets from Registration.php : https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/371e923b7ca221b4309d8892e38da41039f2be1f/registration/Registration.js#L37-L52
- Ensure email uniqueness, where used email cannot be registered anymore.
  Snippets from Registration.php: https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/371e923b7ca221b4309d8892e38da41039f2be1f/registration/Registration.js#L82-L91
### 2. Authentication
### 3. Authorization
### 4. CSS
### 5. CSRF Prevention
### 6. Database Security Principles
- Using prepared statement and parameter binding to ensure the user input treated as data.
  Sinppet from Registration.php ![image](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/92300838/a262b4bf-c93d-488f-8c12-0a1ff6b0ebfb)
### 7. File Security Principles
Create a .htaccess file to protect from unathourize file access.
- Disabling file directory.
  Snippet from .htaccess file ![image](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/92300838/840659f9-c512-4bef-bcae-119f6ed86987)
- Disabling .html extension from URL
  Snippet from .htaccess file ![image](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/92300838/a3c5ddd9-fdbd-46cd-9796-f3f266d2bef7)



### 8. Additional Security Measure
