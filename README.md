<h1 align="center">Laravel API Endpoints</h1>
<h3 align="center">Ready APIs for Auth and Password Reset With Mobile and Email OTP</h1>
<br>

## About This Package

**Laravel API Endpoints** is a comprehensive starter-kit designed for authentication and account recovery, built on the [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum) framework. This package is fully compatible with the [sveltekit-dashboard-starter](https://github.com/theui-dev/sveltekit-dashboard-starter) for a seamless user experience.


**Laravel API Endpoints** is a complete authentication and account recovery starter-kit developed on the top of the [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum). This package is completely compatible with [sveltekit-dashboard-starter](https://github.com/theui-dev/sveltekit-dashboard-starter).

<br>

## Features
This package encompasses a range of features, including but not limited to:
- User registration.
- Email verification.
- Secure login options via either email or mobile number.
- Logout.
- Mobile number verification utilizing OTP.
- Activity logs based on user and associated actions.
- Support for localization.
- User-friendly response and error messaging.

<br>

## API Endpoints
It includes the following endpoints:

| Details                 | Method | API End Points                 |
| ----------------------- | ------ | ------------------------------ |
| Create New Patient      | POST   | [/patients](#)                   |
| Show All Patients       | GET    | [/patients](#)                   |
| Edit Specific Patient   | PUT    | [/patients/{id}](#)                   |
| Show Specific Patient   | GET    | [/patients/{id}](#)                   |
| Registration            | POST   | [/register](#)                 |
| Email verification link | POST   | [/email-verification](#)       |
| Email verification      | POST   | [/verify-email/{id}/{hash}](#) |
| Mobile verification OTP | POST   | [/verification-otp](#)         |
| Mobile verification     | POST   | [/verify-mobile](#)            |
| Login                   | POST   | [/login](#)                    |
| Password reset request  | POST   | [/password-reset](#)           |
| Change Password         | POST   | [/reset-password](#)           |
| Logout                  | GET    | [/logout](#)                   |


<br>

### Create New Patient Endpoint

> Request Method: **POST** <br> Endpoint: **/Patients**

Request Body
```js
{
    "first_name": "Ahmed",
    "last_name": "Mohamed",
    "gender": "Male",
    "age": 30,
    "profile_photo": "[choose photo]"
}
```

Response
```js
{
    "message": "Patient created successfully",
    "data": {
        "id": 1,
        "first_name": "Ahmed",
        "last_name": "Mohamed",
        "profile_photo": "profile_123.jpg",
        "registration_date": "2023-08-20",
        "created_at": "2023-08-20T10:00:00.000000Z"
    }
}
```

<br>

### Show All Patients Endpoint

> Request Method: **GET** <br> Endpoint: **/Patients**


Response
```js
{
    "patients": [
        {
            "id": 1,
            "full_name": "Ahmed Mohamed",
            "profile_photo": "http://localhost/storage/profile_photos/profile_123.jpg"
        },
        {
            "id": 2,
            "full_name": "Nora Ali",
            "profile_photo": null
        }
    ]
}
```

<br>


### Edit Specific Patient Endpoint


> Request Method: **PUT** <br> Endpoint: **/Patients/{id}**

Request Header
```js
{
    "age": 31,
    "condition_description": "Diabetes management"
}
```

Response
```js
{
    "message": "Patient updated successfully",
    "data": {
        "id": 1,
        "age": 31,
        "condition_description": "Diabetes management"
    }
}
```

<br>

### Show Specific Patient Endpoint


> Request Method: **GET** <br> Endpoint: **/Patients/{id}**

Response
```js
{
    
    "data": {
        "id": 1,
        "first_name": "Ahmed",
        "last_name": "Mohamed",
        "gender": "Male",
        "age": 30,
        "profile_photo": "profile_123.jpg",
        "condition_description": null,
        "registration_date": "2023-08-20"
    }

}
```

<br>
### Registration Endpoint

> Request Method: **POST** <br> Endpoint: **/register**

Request Body
```js
{
  "name": "M B Parvez",
  "mobile": "01717000000",
  "email": "user1@email.com",
  "password": "password1",
  "password_confirmation": "password1",
  "country" : "bd",
  "country_code" : "88"
}
```
Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json"
}
```
Response
```js
{
  "user": {
    "name": "M B Parvez",
    "email": "user1@email.com",
    "mobile": "01717000000",
    "country": "bd",
    "country_code": "88",
    "updated_at": "2022-05-08T13:09:53.000000Z",
    "created_at": "2022-05-08T13:09:53.000000Z",
    "id": 1
  },
  "token": "1|qaPeBQyYYYIFDZZ8JPS7OOFONWy1LlgHSg5EzsW8",
  "success": true,
  "message": "Account created successfully!"
}
```

<br>

### Send email verification link

> *Upon completing your registration, an email verification link will be automatically generated and sent to your registered email address. However, in the event that you require manual or second-time verification, you may utilize this end-point.*<br><br>Request Method: **POST** <br> Endpoint: **/email-verification**

Request Body
```js
{
	"email": "user1@email.com"
}
```
Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json",
  'Authorization': "Bearer <SANCTUM_AUTH_TOKEN>"
}
```
Response
```js
{
	"success": true,
	"message": "An email verification link has been sent to your inbox. Please check your email and follow the instructions to complete the verification process."
}
```

<br>

### Verify Email

> *By utilizing this end-point, the user account associated with the provided email address can be verified via the URL sent for verification purposes.*<br><br>Request Method: **POST** <br> Endpoint: **/verify-email/{id}/{hash}**

Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json",
  'Authorization': "Bearer <SANCTUM_AUTH_TOKEN>"
}
```
Response
```js
{
	"success": true,
	"message": "Your email has been successfully confirmed!"
}
```

<br>

### Login Endpoint

> Request Method: **POST** <br> Endpoint: **/login** <br> User can use either Email or mobile number as `userID` for login

Request Body
```js
{
  "userID": "user1@email.com", // or 01717000000
  "password": "password1"
}
```
Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json"
}
```
Response
```js
{
  "user": {
    "id": 1,
    "name": "M B Parvez",
    "email": "user1@email.com",
    "email_verified_at": null,
    "created_at": "2022-05-07T13:26:20.000000Z",
    "updated_at": "2022-05-07T13:26:20.000000Z"
  },
  "token": "2|MyddQxXZvBJ6spzKOI3Kubjte6q3QqS0IYZpZ0uw",
  "success": true,
  "error": false
}
```

<br>

### Password Reset Request Endpoint

> Request Method: **POST** <br> Endpoint: **/password-reset**

Request Body
```js
{
  "userID": "user1@email.com", // or 01717000000
}
```
> You may choose to use either your email or mobile number as your `userID` during login. In both cases, a four to eight digit OTP will be sent to you via either email or mobile, depending on the chosen `userID`.

Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json"
}
```
Response
```js
{
  "success": true,
  "message": "Please check your Email and use to code to reset password."
}
```

<br>

### Password Reset Endpoint

> Request Method: **POST** <br> Endpoint: **/reset-password**

Request Body
```js
{
  "otp": "123456",
  "password" : "password2", // New password
  "password_confirmation" : "password2", // New password confirmation
  "token": "3b1c32e4-8729-481a-8de2-27e3287f8ac3"
}
```
> Will be added automatically with the password reset request.

Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json"
}
```
Response
```js
{
  "success": true,
  "message": "Password updated successfully! Login to your account to continue."
}
```

<br>

### Logout Endpoint

> Request Method: **GET** <br> Endpoint: **/logout**

Request Header
```js
{
  "Content-Type": "application/json"
  "Accept": "application/json",
  'Authorization': "Bearer <SANCTUM_AUTH_TOKEN>"
}
```
