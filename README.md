# WEBAPPSECURITY-IMPROVED
# Final Assessment INFO 4345 | RAZER
## Group Member
|Member                      |Matric ID| Assigned Tasks
|----------------------------|---------|---------
|Aiman Fathi Bin Mohd Fairuz |2121549  | Regex application, input validation, authentication of admin login, application of session and timeout, authorization for admin access, password hashing
|Safwan bin Roslin           |2113779  | XSS Prevention and CSRF Prevention
|Muhammad Haniff bin Ismail  |2110619  | Database Security Principles and File Security Principles

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
- Using Regular Expression to ensure that only allowed characters can be entered as input. <br>
  Snippets from Registration.js : https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/371e923b7ca221b4309d8892e38da41039f2be1f/registration/Registration.js#L37-L52 <br>

- Ensure that email & matric number can only be registered once by user.
  Snippet from Registration.php: https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/dc3f9b3a7e632b1befeac1cdb96b4ac00e9eaaae/registration/Registration.php#L28-L49

<a id="authentication"></a>
### 2. Authentication
Implement authentication for admin login to ensure safety when accessing user data.
- Admin does not need to sign up as the credentials are already put in the database system. Only requires login. Login password are hashed using default hashing. <br>
  https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/c3a0d9ffdfc10dc7b34c8d9b8e06ea2daa02971e/admin/7355608.php#L16-L25 <br>
  ![Desktop Screenshot 2024 06 26 - 13 07 23 36](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/128023708/fb268b6b-5f91-4e6f-b993-1cf4bbefbce4)


<a id="authorization"></a>
### 3. Authorization
Allow certain feature to be access by particular personnel only.
- User: Only allow to register as member without login.
- Admin: Can login to admin dashboard to do CRUD activities such as View, Add, Edit and Delete member's lists.

<a id="XSS"></a>
### 4. XSS Prevention
- This code snippet demonstrates how to protect a web application from Cross-Site Scripting (XSS) attacks by sanitizing user input. XSS attacks occur when an attacker is able to inject malicious scripts into web pages viewed by other users. To prevent this, the code uses the htmlspecialchars function to convert special characters to their HTML entities, thus preventing the execution of any embedded scripts. <br><br>
- Snippet from dashboard.php : https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/fc7f60415b65f40fb5b9dfa5e4ac57190d18330b/admin/dashboard.php#L126-L129 <br>
  https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/fc7f60415b65f40fb5b9dfa5e4ac57190d18330b/admin/dashboard.php#L156-L160 <br>
- `htmlspecialchars()`: This function converts special characters to HTML entities. For example: <br>
  `&` becomes `&amp;` <br>
  `<` becomes `&lt;` <br>
  `>` becomes `&gt;` <br>
  `"` becomes `&quot;` <br>
  `'` becomes `&#039;` <br> <br>
- By using htmlspecialchars, the script ensures that any HTML or JavaScript code submitted through the form will be displayed as plain text, rather than being executed by the browser. This prevents malicious scripts from running and potentially compromising the security of the website or its users. <br>

<a id="CSRFprevention"></a>
### 5. CSRF Prevention
- This code snippet is an example of a function designed to prevent Cross-Site Request Forgery (CSRF) attacks in a web application. CSRF attacks occur when a malicious actor tricks a user into performing actions on a web application without their knowledge or consent. This function helps ensure that any form submission or request comes from an authenticated and legitimate source. <br><br>
- Snippet from dashboard.php : https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/fc7f60415b65f40fb5b9dfa5e4ac57190d18330b/admin/dashboard.php#L26-L36 <br>
- The csrf_check function ensures that any request to the server includes a valid CSRF token, thereby protecting the application from CSRF attacks. If the token is missing or invalid, the function responds with a 405 status code and an error message, and halts further execution. This helps maintain the security and integrity of user actions within the application. <br>

<a id="databaseSecurity"></a>
### 6. Database Security Principles
- The use of prepared statements and parameter binding helps prevent SQL injection attacks, which are a common security vulnerability in web applications. <br>
- Snippet from Registration.php https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/registration/Registration.php#L50-L61 <br>
- Snippet from login.php https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/admin/login.php#L25-L31

<a id="fileSecurity"></a>
### 7. File Security Principles
Create a .htaccess file to protect from unathourize file access.
- Disabling file directory. <br>
  Snippet from .htaccess file https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/.htaccess#L1-L3
- Disabling .html extension from URL <br>
  Snippet from .htaccess file https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/875e27075e5a366fade9704739da60e7942eec24/.htaccess#L5-L21

<a id="addSecurity"></a>
### 8. Additional Security Measure

- Implementing HTTPS (HTTP Secure) protocol involves using SSL certificate to secure the communication between a client and a server.
- ![Screenshot 2024-06-26 132130](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/106056077/626c537a-19ee-4568-9d96-d60ffa12aba8)


- Session timeout implementation. Any inactivity after 10 minutes will be automatically logged out.
  Snippets from dashboard.php: https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/blob/dd8307662aba1fe27f6828a5b51f9c61afd5125a/admin/dashboard.php#L7-L24

- Admin Login Implementation: We make sure the login page for admin is not easily noticable by other party by placing it in place where people rarely look at.
![Desktop Screenshot 2024 06 26 - 13 07 12 66](https://github.com/aemon1407/WEBAPPSECURITY-IMPROVED/assets/128023708/81c741b6-f5cd-445f-aaf4-787b19a775ba)



## REFERENCES

1. OWASP Top Ten: Guidance on the top ten critical web application security risks and how to mitigate them effectively.
   https://owasp.org/www-project-top-ten/<br>
   
2. PHP Security Guide: Best practices and guidelines for securing PHP applications, covering authentication, input validation, and more.
   https://www.php.net/manual/en/security.php<br>
   
4. XAMPP Documentation: Documentation on configuring and securing XAMPP, ensuring a secure local development environment.
   https://www.apachefriends.org/docs/ <br>
   
5. DigitalOcean Documentation: Documentation for live server hosting. Deployed on DigitalOcean cloud platform using their droplet product. We have used the LAMP (Linux, Apache, MySQL, PHP) stack on Ubuntu 22.04
https://docs.digitalocean.com/ <br>

6. Adminer Documentation: Comprehensive documentation on securing Adminer databases, covering user management, access controls, and secure connections.
https://www.adminer.org/ <br>

## APPENDICES

- Link for live website:
  https://pembina.ikool.dev <br>
  
- Link for Weekly Progress Report:
  https://docs.google.com/spreadsheets/d/1XpU0imtoFTx7YCEVMPMdL3bZJYmdiSyc/edit?usp=sharing&ouid=100056917870560752486&rtpof=true&sd=true
  
