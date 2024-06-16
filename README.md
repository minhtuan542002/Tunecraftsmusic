# TuneCraft Studio Online Platform


## Getting started

- [ ] Clone the Repository: Use the provided Git link.
```
git clone https://github.com/minhtuan542002/Tunecraftsmusic.git
```
- [ ] Configure the Server: Set up your web server (Apache, Nginx, etc.) to serve the website files. Ensure the document root points to the webroot directory of the cloned repository.

## Install dependancies

- [ ] Navigate to the project directory and install the necessary dependencies:
```
composer install
```

## Configure Database Connection

- [ ] Set up a database with schema.php in the repo main
- [ ] Open config/app_local.php.
- [ ] Modify the database settings in the Datasources section:
```
'Datasources' => [
    'default' => [
        'host' => 'your_database_host',
        'username' => 'your_database_username',
        'password' => 'your_database_password',
        'database' => 'your_database_name',
    ],
],
```
## Set Environment Variables

- [ ] Disable Debugging for Production
```
'debug' => false,
```
- [ ] Generate a Fresh Secret Key
```
'Security' => [
    'salt' => 'your_new_secret_key',
],
```
- [ ] Set Up SMTP for Email:
```
'EmailTransport' => [
    'default' => [
        'host' => 'smtp.your-email-provider.com',
        'port' => 587,
        'username' => 'your_email@example.com',
        'password' => 'your_email_password',
        'className' => 'Smtp',
        'tls' => true,
    ],
],
```
Note that you will need to create an SMTP server or register your mail as one


***
