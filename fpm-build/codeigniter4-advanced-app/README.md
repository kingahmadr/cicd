# CodeIgniter 4 Advanced Project Template

[Yii 2 Advanced Project Template](https://github.com/yiisoft/yii2-app-advanced) ported to CodeIgniter 4.

|Screenshots|||
| --- | --- | --- |
| ![Welcome Page](https://github.com/denis303/codeigniter4-advanced-app/raw/master/_images/screen_welcome.png) | ![Signup](https://github.com/denis303/codeigniter4-advanced-app/raw/master/_images/screen_signup.png) | ![Login](https://github.com/denis303/codeigniter4-advanced-app/raw/master/_images/screen_login.png) |
| ![Reset Password](https://github.com/denis303/codeigniter4-advanced-app/raw/master/_images/screen_reset_password.png) | ![Resend Verification](https://github.com/denis303/codeigniter4-advanced-app/raw/master/_images/screen_resend_verification.png) | ![Contact Form](https://github.com/denis303/codeigniter4-advanced-app/raw/master/_images/screen_contact.png) |

## Overview

  - Signup
  - Login
  - Logout
  - Email Confirmation
  - Password Reset
  - Contact Form
  
Remember me feature not working correct in Chrome (and other browsers) when:
 
1. On Startup = "Continue where you left off"
2. Continue running background apps when Google Chrome is closed = "On"

In this case browser not clean remember me cookie when remember me flag is not checked. This is not a bug in the code, but a feature of modern browsers. 

## Installation

`composer create-project denis303/codeigniter4-advanced-app --stability=dev`

## Setup

1. Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

3. Run `php spark migrate -all`.

## Usage

If you don't receive email, you can create links manually: 

- verification: /user/verifyEmail/<users.id>/<users.email_verification_token>
- reset password: /user/resetPassword/<users.id>/<users.password_reset_token>

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
