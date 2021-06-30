# 'SlimJIM - Job Management Interface'

### Institution, Module, & Student Information
- **Institution:** Griffith College Dublin
- **Course Name:** B.Sc. (Hons) in Computing Science
- **Module Name:** Software Development Project
- **Module Code:** BSCH-SDP/Dub/PT
- **Student Name:** Alex Meade Wilson
- **Student Number:** 2950871

### Assignment Information
- **Title:** Final Software Development Project
- **Description:** SlimJIM - Job Managment Interface
- **In Support of:** Dissertation: Optimizing Field Service Management through Software as a Solution
- **Submission Date:** Monday 14th May 2021 at 23:55 (Irish Summer Time)

### Online Application & Source Code (For a limited time only)
- **Application Name:** _"SlimJIM - Job Management Interface" (Field Service Management Solution)_ 
- **Scheduler UI Application Code:** [https://github.com/AlexMeadeWilson/SDP.Scheduler](https://github.com/AlexMeadeWilson/SDP.Scheduler)
- **Mobile UI Application Code:** [https://github.com/AlexMeadeWilson/SDP.Mobile.UI](https://github.com/AlexMeadeWilson/SDP.Mobile.UI)
- **Web Application:** [https://knuth.griffith.ie/~s2950871/SlimJIM](https://knuth.griffith.ie/~s2950871/SlimJIM)

### Local Installation Steps
_To install and run this application locally, please follow these simple steps._

##### Pre-Requisites
- The ability to run and edit PHP and MySQL Server instances locally.
- I recommend WampServer which can be downloaded from here: [https://www.wampserver.com/en/download-wampserver-64bits/]
- A decent syntax highlighting text editor or IDE with support for PHP, HTML, CSS, JS, Ajax and JSON.
- I recommend Visual Studio Code for this. 
- You can download VS Code from here: [https://code.visualstudio.com/download](https://code.visualstudio.com/download)
- Android Studio (IDE). You can download Android Studio from here: [https://developer.android.com/studio](https://developer.android.com/studio)
- Finally, to establish an instant, secure URL to your localhost server through any NAT or firewall using ngrok tunnels.
- Download, and install ngrok from here: [https://ngrok.com/product](https://ngrok.com/product)

##### Unzip the Application Code Package
- You should have 3 x primary directories and a README.md file.
1. Mobile.UI
2. Scheduler
3. Scheduler DB

##### Install and Run the MySQL Database
- Run WampServer and open phpMyAdmin
- Go to the 'Import' tab, and import the 'SlimJIM' MySQL database from the Scheduler.DB directory.
- This is a SQL Dump File of the database at the point of submission on 14th June 2021.
- Ensure the Database is running.

##### Establish Local Network Tunnel using ngrok, to run both Scheduler UI and the Mobile UI
- Run ngrok.exe console administrator and establish a tunnel on local port 8000 as follows;
- 'ngrok.exe http 8000'
- Copy the resultant URL. Example: https://1a2a3eddb189.ngrok.io -> http://localhost:8000 

##### Run the Scheduler UI
- From the directory \Scheduler\public\front-end open the file 'config.js'
- Replace the value for "var api_host = 'https://1a2a3eddb189.ngrok.io';" with the new ngrok URL above.
- Use a command line Administrator to the run the Web App over localhost, within the established ngrok tunnel above.
- From the Scheduler\public directory, type 'php -S localhost:8000'
- Open the the new ngrok URL root directory in a browser and verify the Scheduler UI loads, with Jobs as data.

##### Run the Mobile UI
- Within Android Studio, open the Mobile.UI App at the root.
- Navigate to directory: 'app\src\main\java\com\example\mobileui' and open the 3 x Fragment class files;
- Namely, Fragment1_Overdue.java, Fragment2_Today.java, Fragment3_Upcoming.java
- In each class file, update the variable value for 'String ngrok' to the latest ngrok tunnel URL above. 
- Build and Run the Mobile App.

### SlimJIM is now Ready for Use!
- To test the end-2-end, create a Job in the Scheduler UI
- Then check the Mobile UI by a new build or pull to refresh to see the Jobs.

_Thank you, and enjoy "SlimJIM - Job Management Interface"._
_Alex Meade Wilson (2950871)._
