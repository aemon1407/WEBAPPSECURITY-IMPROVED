# WEBAPPSECURITY-IMPROVED
# Final Assessment INFO 4345 | RAZER
d
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
- Using Regex & htmlspecialchar, to ensure that only allowed characters can be entered as input. <br>
  Snippets from Registration.js : https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/371e923b7ca221b4309d8892e38da41039f2be1f/registration/Registration.js#L37-L52
  Snippets from Registration.php: https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/dc3f9b3a7e632b1befeac1cdb96b4ac00e9eaaae/registration/Registration.php#L21C5-L27C1
- Ensure email & matric number uniqueness, where used email and matric number cannot be registered anymore. <br>
  Snippet from Registration.php: https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/dc3f9b3a7e632b1befeac1cdb96b4ac00e9eaaae/registration/Registration.php#L28-L49

  
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
  Snippet from Registration.php https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/registration/Registration.php#L50-L61 <br>
  Snippet from login.php https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/admin/login.php#L25-L31
<a id="fileSecurity"></a>
### 7. File Security Principles
Create a .htaccess file to protect from unathourize file access.
- Disabling file directory. <br>
  Snippet from .htaccess file https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/.htaccess#L1-L3
- Disabling .html extension from URL <br>
  Snippet from .htaccess file https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/.htaccess#L5-L21
<a id="addSecurity"></a>
### 8. Additional Security Measure
