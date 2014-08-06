PecSwap
=======

Technologies used : PHP, HTML-CSS

An online portal that facilitates users to exchange items and discuss ideas.
Features:
  1. Free Classifieds.
  2. Forums
  3. USer Profiles
  
How to use?

1. Copy the pecswap folder in the htdocs(if using xampp) or www(if using wamp) or other appropriate place depending upon your server.
2. Create database and tables from pecswap.sql file.
3. Open connection.php in the pecswap folder and change the mysql username and password accordingly.
4. Now you can access the site from localhost/pecswap.


Documentation:

Login Mechanism : if a user logins, ession variable 'sid' is set. When he closses the browser window(i.e. ends the session), value of session variable is stored in a cookie named 'sid' just before the session ends. Now if the user access the site on the same browser, forst of all value of cookie 'sid' is checked. If it exists, that value is stored in session variable 'sid' and user is logged in. When the user presses 'logout', session variable as well as cookie is destroyed. 

1. index.php
->if(user is logged in) no sign-in form, no register tab, logout tab
->else sign-in form, register tab, no logout-tab.
      
->latest advertisements and latest members fetched from the database and shown in the home page. user can click on the ad or member to know the details.

2. signup.php
->if(user is logged in) he is asked to logout first.
->form displayed with these fields: Name, SID, Contact No., Email-is, Password and Confirm Password.
->once the data is entered, validations are performed on the back-end and data is entered in the database.

3. login.php
->user asked to enter sid and password.
->if data is correct, session variable 'sid' is set.
->else error message.

...to be continued.
