
>> [<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<]    
># [- HTML ADMIN WITH SCSS -]  
>## NOTE: not responsive yet! 
>![ SCSS HTML ADMIN ](/img/screenshot_1.png)
>   
>> [<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<]    
# APP

## usage






## *INSTALLING FOR DEVELOPMET*

# Install npm SASS
npm install -g sass</br>

# Run command to update CSS by editing SCSS
sass --watch src/scss:src/css</br>

# One Install To bind them all
npm install gulp gulp-concat gulp-minify-css gulp-autoprefixer gulp-rename gulp-sass toastr bootstrap-colorpicker popper.js@1.14.3 bootstrap@4.x.x jquery particles.js @iconscout/unicons @fortawesome/fontawesome-free sweetalert2

# Run npm installs for gulp to work
npm install sweetalert2</br>
npm install gulp</br>
npm install gulp-concat</br>
npm install gulp-minify-css</br>
npm install gulp-autoprefixer</br>
npm install gulp-rename</br>
npm install gulp-sass</br>

# Also few frontend libraries
npm install toastr</br>
npm install bootstrap-colorpicker</br>
npm install popper.js@1.14.3</br>
npm install bootstrap@4.x.x</br>
npm install jquery</br>
npm install particles.js</br>
npm install @iconscout/unicons</br>
npm install @fortawesome/fontawesome-free
npm install sweetalert2

# So you can run "gulp" command in root and have .min.css file(s) exported
gulp min-css-export-single-file</br>
gulp min-css-export-all</br>
gulp sass-export</br>
gulp watch</br>




**First create users in the "api_db" database**

	CREATE TABLE users (
		id int NOT NULL AUTO_INCREMENT, 
		firstname varchar(255) NOT NULL,
		lastname varchar(255) NOT NULL, 
		email varchar(255) NOT NULL, 
		password varchar(255) NOT NULL, 
		created datetime  DEFAULT CURRENT_TIMESTAMP NOT NULL, 
		modified timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
		PRIMARY KEY (id)
	);

**Start PHP Server in project root**

	php -S localhost:8080

**Create user**
	
	http://localhost:8080/api/create_user.php

With request body data

	{
    	"firstname" : "yeaUser",
    	"lastname" : "Ilic",
    	"email" : "yeaUser@yeaMailDomain.com",
    	"password" : "555"
	}

**Login user**

	http://localhost:8080/api/login.php

Enter in body
	
	{
    "email" : "yeaUser@yeaMailDomain.com",
    "password" : "555"
	}

**Test token access**

	http://localhost:8080/api/validate_token.php

Enter in request body

	{
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MFwvIiwiYXVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwODBcLyIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7ImlkIjoiMiIsImZpcnN0bmFtZSI6Ik1pa2UiLCJsYXN0bmFtZSI6IkRhbGlzYXkiLCJlbWFpbCI6Im1pa2VAY29kZW9mYW5pbmphLmNvbSJ9fQ.nyMRPlg0MSI_8xevui3aeW9suDHjBA6PWk05igYT_OY"
	}

**Update user**

	http://localhost:8080/api/update_user.php

Body has the following details

	{
	    "firstname" : "yeaUser",
	    "lastname" : "Ilic",
	    "email" : "yeaUser@yeaMailDomain.com",
	    "password" : "555",
		"jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4MFwvIiwiYXVkIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwODBcLyIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7ImlkIjoiMiIsImZpcnN0bmFtZSI6Ik1pa2UiLCJsYXN0bmFtZSI6IkRhbGlzYXkiLCJlbWFpbCI6Im1pa2VAY29kZW9mYW5pbmphLmNvbSJ9fQ.nyMRPlg0MSI_8xevui3aeW9suDHjBA6PWk05igYT_OY"
	}					
