# Entry-Management-System

#Description
The Entry management system is designed to get the session details of the visitor to the host and to the visitor after check out.
It takes the details as Name, Phone Number, Email from user at the time of visit and stores it with the check_in time.
After the login of the visitor to the system, the host gets an email and sms both regarding the established session.
The visitor can access the other services of the website available.
If the visitor checks out the complete session detail is then updated in the system and he/she gets the email regarding the session.
Logout redirects the user to the initial login interface of the system as his/her session is ended and he/she can not access services after session ends.

#Technology Stack
----Front-end----
HTML5,CSS3,JavaScript,Bootstrap4
----Back-end----
PHP
Database
MySQLi
Email,SMS and all features are implemented on Localhost (i.e. Xampp server)

#Exceptions
Before working the databases,tables must be imported.
The credential.php file must be updated, and if SMTP error occurs Unlock Captcha of the account and allow Low security app access of the account.
SMS API must be enabled or get it by from WAY2SMS by registering to get API and secret key (Its free).
All the host email address and phone number must be updated to get the SMS and Mail.
