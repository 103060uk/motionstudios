Motion Studios - CMS Implementation
Project Name: Motion Studios - News Page CMS Implementation

Project Overview:
The project is a web application designed for a music studio called Motion Studios, based in South London. It serves as a platform for publishing and managing articles, with features for user registration, authentication, article creation, and administration. The application follows the Model-View-Controller (MVC) architecture for efficient code organisation and maintenance.

Key Features:
User Registration and Authentication: Users can sign up for accounts and log in securely to access the platform. 
Article and User Management: Users can create, edit, and delete articles. Admins have additional privileges for managing user accounts and articles. 
Role-Based Access Control: Different user roles (standard users and admins) have different levels of access and permissions. 
Quantifiable User Interest: Like and share button functionality for each published article for any user’s logged in.

Table of Contents:
1. Installation
2. Usage
3. Folder Structure
4. Technologies Used
5. Contributors
6. License

1. Installation:

Install XAMPP:
Download and install XAMPP from the official website: https://www.apachefriends.org/index.html
Follow the installation instructions for your operating system.

Launch XAMPP:
Once installed, open the XAMPP application.
Start both the Web Server and the MySQL Database servers from the XAMPP control panel.

Set Up Project Directory:
Navigate to the XAMPP installation folder.
Open the 'htdocs' folder.
Create a new folder named ‘php_program’ (or any other preferred name).

Clone Repository or Copy Files:
Clone your project repository into the ‘php_program’ folder created in the previous step using Git:
     ```
     git clone <insert repository once created…>
     ```
Alternatively, download the project files and copy them into the ‘php_program’ folder.

Run the Project:
Open your web browser.
Enter the following URL in the address bar:
     ```
     http://localhost/php_program/controller/home.php
     ```
Replace ‘php_program’ with the name of the folder containing your project files if you chose a different name.
Press Enter to access your project.
You should now be able to view and interact with your project in the web browser.

**Note: It's important to run the project from the 'htdocs' folder within the XAMPP directory to ensure proper functionality. Accessing the project from other locations may result in errors.**

2. Usage:

Accessing the Website:
After setting up the project as per the installation instructions, open your web browser.
Enter the following URL in the address bar:
     ```
     http://localhost/php_program/controller/home.php
     ```
Replace ‘php_program’ with the name of the folder containing your project files if you chose a different name.
Press Enter to access your project.

Navigation:
Once the project is loaded in the web browser, you will see the homepage or landing page.
Navigate through the various pages using the links provided in the navigation menu or buttons.

Features:
Explore the different features of the website, such as viewing articles, logging in, signing up, liking articles, etc.
Interact with the website's functionality as intended to understand its capabilities fully.

Admin Portal:
Access the admin portal to perform administrative tasks such as managing users and articles using the following credentials:
     ```
     Username: admin1
     Password: admin0000
     ```
Admin features include adding, reading, editing, or deleting users/articles.

Logging Out:
When you're done using the website, click on the logout button (if available) to log out of your account securely.
This will end your session and redirect you to the news page.

Troubleshooting:
If you encounter any issues or errors while using the website, refer to the error messages displayed on the screen for guidance.
Check the README file or documentation provided with the project for troubleshooting tips or additional information.

Feedback:
Provide feedback on your experience using the website to help improve its usability and functionality.
Report any bugs or issues to the project maintainer for resolution.

Further Assistance:
If you need further assistance or have questions about specific features or functionalities, refer to the documentation or contact the project maintainer for support.

3. Folder Structure:

|-v2_motion_studios
|---------	controller
|---------|--------	add_user.php
|---------|--------	admin_portal.php
|---------|--------	contact.php
|---------|--------	delete_article.php
|---------|--------	delete_user.php
|---------|--------	error.php
|---------|--------	home.php
|---------|--------	like.php
|---------|--------	login.php
|---------|-------	logout.php
|---------|--------	news.php
|---------|--------	our_story.php
|---------|--------	our_work.php
|---------|--------	studio_overview.php
|---------|--------	update_article.php
|---------|--------	upload_article.php
|---------	model
|---------|--------	dbh.inc.php
|---------	public
|---------|--------	[All images and icons]
|---------	view
|---------|--------	partials
|---------|---------|--------	footer.php
|---------|---------|--------	navbar.php
|---------|--------	style
|---------|---------|--------	_footer.scss
|---------|---------|--------	_header.scss
|---------|---------|--------	_reset.scss
|---------|---------|--------	_variables.scss
|---------|---------|--------	_footer.scss
|---------|---------|--------	motion_studios.scss
|---------|---------|--------	motion_studios.css
|---------|--------	add_user.php
|---------|--------	admin_portal.php
|---------|--------	contact.php
|---------|--------	delete_article.php
|---------|--------	delete_user.php
|---------|--------	error.php
|---------|--------	home.php
|---------|--------	like.php
|---------|--------	login.php
|---------|--------	logout.php
|---------|--------	news.php
|---------|--------	our_story.php
|---------|--------	our_work.php
|---------|--------	studio_overview.php
|---------|--------	update_article.php
|---------|--------	upload_article.php

4. Technologies Used:

PHP: Server-side scripting language used for backend development.
MySQL: Relational database management system used for data storage and retrieval.
HTML: Markup language used for structuring web pages.
CSS: Styling language used for designing the appearance of web pages.
JavaScript: Programming language used for adding interactivity and dynamic behavior to web pages.
MVC Architecture: Design pattern used for organising code into Model, View, and Controller components for better maintainability and scalability.
XAMPP: Cross-platform web server solution stack package that includes Apache HTTP Server, MySQL database, and PHP interpreter for local development and testing.
Git: Version control system used for tracking changes in project files and collaborating with team members.
GitHub: Web-based platform used for hosting Git repositories and managing project development workflows.
