Environment Setup

Web Server : Nginx

Steps:
1. Install Nginx on machine
2. Create server block in Nginx.

Reference link - https://www.digitalocean.com/community/tutorials/how-to-set-up-nginx-server-blocks-virtual-hosts-on-ubuntu-16-04

3. Make sure the root is setup to {PROJECT_PATH}/public
as the index.php resides here in CodeIgniter.

4. Provide full access to the project folder, if not there will be an error. 
Command - chmod -R 755 {PROJECT_PATH}

5. Change the "$baseURL" in app/config/app.php

6. Change Database Configurations in app/config/database.php

 
 