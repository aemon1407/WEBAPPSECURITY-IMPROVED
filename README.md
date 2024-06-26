# WEBAPPSECURITY-IMPROVED
# Final Assessment INFO 4345 | RAZER

## Group Member
|Member                      |Matric ID| Assigned Tasks
|----------------------------|---------|---------
|Aiman Fathi Bin Mohd Fairuz |2121549  | Regex application, input validation, authentication of admin login, application of session and timeout, authorization for admin access, password hashing
|Safwan bin Roslin           |2113779  |
|Muhammad Haniff bin Ismail  |2110619  |

## Table of Content
1. [Input Validation](#inputValidation)
2. [Authentication](#authentication)
3. [Authorization](#authorization)
4. [XSS Prevention](#XSS)
5. [CSRF Prevention](#CSRFprevention)
6. [Database Security Principles](#databaseSecurity)
7. [File Security Princliples](#fileSecurity)
8. [Additional Security Measurements](#addSecurity)

## Brief Description
Web application development is not just about applying business logic and automation of a business flow. It is more on providing a secure service to its users and ensure its availability when it is needed. In any web application development, the most common concerns are input validation, authentication, authorization, XSS and CSRF prevention, and enforcing database and file securities. Thus, for web application security group project we are required to enhance our previous web application development from Web Technologies (INFO 2302) and apply all the security elements or components that we have learned in class to ensure the previous developed web application is hardened with the required security elements or components. 

## Title
PEMBINA IIUM

## Introduction

## Objective of the Enchancements
The objective of this website enhancement is to significantly improve its security by implementing comprehensive measures. Input validation for ensuring proper data enters the system, authentication and authorization for verifying user identities and controlling access, XSS prevention for mitigating script injection attacks, CSRF prevention for protecting against unauthorized actions, database security principles for safeguarding data integrity, file security principles for ensuring secure file handling, and additional security measurements to address potential vulnerabilities and enhance overall protection. These enhancements will create a secure, reliable, and efficient platform for all users.

## Web Application Security Enhancements
<a id="inputValidation"></a>
### 1. Input Validation
Implemented input validation to prevent unwanted characters or format for every user input.
- Using Regex, to ensure that only allowed characters can be entered as input. <br>
  Snippets from Registration.php : https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/371e923b7ca221b4309d8892e38da41039f2be1f/registration/Registration.js#L37-L52
- Ensure email uniqueness, where used email cannot be registered anymore. <br>
  Snippet from Registration.php: https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/371e923b7ca221b4309d8892e38da41039f2be1f/registration/Registration.js#L82-L91
<a id="authentication"></a>
### 2. Authentication
<a id="authorization"></a>
### 3. Authorization
<a id="XSS"></a>
### 4. XSS Prevention
<a id="CSRFprevention"></a>
### 5. CSRF Prevention
<a id="databaseSecurity"></a>
### 6. Database Security Principles
- Using prepared statement and parameter binding to ensure the user input treated as data. <br>
  Snippet from Registration.php ![image](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/92300838/a262b4bf-c93d-488f-8c12-0a1ff6b0ebfb)
<a id="fileSecurity"></a>
### 7. File Security Principles
Create a .htaccess file to protect from unathourize file access.
- Disabling file directory. <br>
  Snippet from .htaccess file ![image](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/92300838/840659f9-c512-4bef-bcae-119f6ed86987)
- Disabling .html extension from URL <br>
  Snippet from .htaccess file ![image](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/92300838/a3c5ddd9-fdbd-46cd-9796-f3f266d2bef7)
<a id="addSecurity"></a>
### 8. Additional Security Measure
