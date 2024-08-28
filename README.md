

Backend Developer Practical Test
Documentation

28/10/2024
 
 

 
[Aung Khant Zin]
[BACKEND DEVELOPER PRACTICAL TEST]
REVISION DATE: [28/10/2024]

 
Contents
Section 1   Introduction	3
Section 2   Technical Documentation	3

 
Section 1   Introduction 
	With over two years of hands-on experience in the software development field, I am a dedicated and versatile software developer skilled in both frontend and backend technologies. My journey has equipped me with a solid understanding of creating seamless user experiences and robust server-side solutions. I have a proven track record of delivering high-quality code and innovative solutions, and I thrive in dynamic environments where I can leverage my technical expertise to contribute to impactful projects. 
Section 2   Technical Documentation
	Before the development, I created the github repository to make the continuous update of my development files. Then, I created the local folder and clone the github project from the link that I received. I checked overview of the project and first of all, I added my name in composer.json file and then I installed required libraries and dependencies by typing composer install in terminal. 
1.	API / Login
I updated the rules and messages for additional validation and then update the LoginController to use LoginRequest. And finally, added ctji-api guard configuration under the guard section in config/auth.php file. Finally, verify that Login Resource can handle response when a user successfully login.
2.	API / Post
To use eloquent relationships between Post, user, tag and like, I updated the models under App/Models to ensure that- 
•	user Relationship: Defines a belongsTo relationship between Post and User using the author_id foreign key.
•	likes Relationship: Defines a hasMany relationship between Post and Like.
•	tags Relationship: Defines a belongsToMany relationship between Post and Tag.
Optimized the Query:  Used eager loading for tags and likes, and added withCount for likes in the index method https://github.com/kaungkaunglay/backend-developer-practical-testof PostController.
Used Resource: Returned the Post Resource collection in the index method






3.	API / Posts/ Reaction
Changed the Coding Style for Request Validation: Used the existing PostToggleReactionRequest for validation. And I Simplified the logic forliking or unliking a post in the react method of PostController.
4.	Wifi Calculator
Define the interface

First, we define an interface for the Internet Service Provider (ISP) that will enforce the contract for all ISP implementations.

app/Services/InternetServiceProvider/InternetServiceProviderInterface.php


Create an Abstract Class

Next, we create an abstract class that implements the interface and provides common functionality for all ISPs.

app/Services/InternetServiceProvider/InternetServiceProviderAbstract.php

Implement Concrete Class 

Now, we implement the concrete classes for each ISP, extending the abstract class.

app/Services/InternetServiceProvider/Mpt.php
app/Services/InternetServiceProvider/Ooredoo.php

We create a factory to instantiate the appropriate ISP class based on the provider name.

app/Factories/InternetServiceProviderFactory.php

We implement the controller to handle the API requests and use the factory to get the appropriate ISP instance.

app/Http/Controllers/InternetServiceProviderController.php

Finally, we define the routes to handle the API requests.

routes/web.php


5.	Staff Service: Ensure the Staff service has a method salary that processes the payroll data.
StaffController: Update the StaffController to handle request data, validate it if necessary, and pass it to the Staff service.
Route: Define the route for the payroll in the web.php file.

Applicant Service: Ensure the Applicant service has a method applyJob that processes the job application.
JobController: Update the JobController to handle request data, validate it, and pass it to the Applicant service.
Route: Define the route for the job application in the web.php file.

Finally As for the test units, I created the Unit Tests: Using php artisan make:test LoginApiTest.

	
