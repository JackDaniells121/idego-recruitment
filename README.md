## Task describtion from email

Implement login page with two step authentication and error handling* Login form with email and password fields and submit button
* User should be able to submit the form using “Sign in” button or by hitting Enter key on the keyboard
* Form submission should be available only when the form is filled and the user provides valid email (valid in terms of format, not existing user account)
* Validation errors should be shown on the screen
* Login failure should be presented to the user as a snackbar/notification
* After successful email / password authentication the user should provide OTP/TOTP code for two-factor authentication if backend decides
* After successful two-step authentication the user should be logged in and redirected to home page
* The user should remain logged in when the app is reloadedBackend should contain login endpoint that will return acknowledge that user provided correct credentials. There should be two users hardcoded into backend, and one of them should have OTP enabled. Implementation for OTP is not necessary, and can accept 111111 all the time.You may use framework of your choice or pure PHP - as you wish.
  We won’t evaluate frontend part - don’t worry about CSS, etc. please focus on the API.
  Please commit all the changes and share with us the link to your github/gitlab public repo.

## Installation

1. git clone https://github.com/JackDaniells121/idego-recruitment.git
2. composer install
3. symfony server:start
4. http://127.0.0.1:8000/start
5. Test credentials :
   1. email: test@test.pl / password: 1 / otp: 111111
   2. email: test2@test.pl / password: 1
   
   
   ![Zrzut ekranu 2022-07-27 o 19 33 55](https://user-images.githubusercontent.com/35567187/181312295-792321d4-56f9-4dd2-b420-7cd810b8e4a1.png)
