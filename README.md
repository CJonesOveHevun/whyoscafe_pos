# Whyos Cafe Inventory 
Mock web-based Inventory system for school project.
This is a simple inventory system developed by
3 members in this group. Built mainly using PHP and MongoDB.
It allows users to add items and view dashboards dsiplaying inventory records.

Link of Deployment:
https://whyoscafepos-production.up.railway.app/

<table>
  <tr>
    <th>
    </th>
    <th>
    Platform
    </th>
  </tr>
  <tr>
    <th>
    Deployment: 
    </th>
    <th>
    <a href="https://railway.com/">Railway.com</a>
    </th>
    
  </tr>
  <tr>
    <th>
    Database: 
    </th>
    <th>
    <a href="https://www.mongodb.com" >MongoDB</a> via Atlas
    </th>
  </tr>
  <tr>
    <th>
    Repository: 
    </th>
    <th>
    GitHub
    </th>
  </tr>
  <tr>
    <th>
    Backend: 
    </th>
    <th>
    PHP
    </th>
  </tr>
  <tr>
    <th>
    IDE: 
    </th>
    <th>
    Visual Studio Code
    </th>
  </tr>
</table>

# Prerequisites
The requirements for developing this project includes:
- **PHP 8.2**
- **XAMPP**, for local development
- **Composer**
- **MongoDB Atlas**
- **PHP Driver**
   - ('mongodb/mongodb')
   - installed via Composer
- **Dockerfile**, since native PHP in Railway does not include MongoDB Atlas support, a custom Dockerfile was created.

# Development Process
## 1. Local development with Visual Studio Code and XAMPP
Project files are created and edited through VS Code and used XAMPP to run local Apache server and PHP environment and files were put in 'htdocs' folder. Git is used to version control the project and to remote Github Repository.

## 2. MongoDB Integration
We used MongoDB Atlas as the cloud-based database provider and installed MongoDB PHP Driver using Composer in the terminal:
```
composer require mongodb/mongodb
```

## 3. Testing on Localhost
Testing was performed via browser through local XAMPP Server. We verified the connections in MongoDB Atlas and the operations such as add/edit/delete.

## 4. Deployment
A `Dockerfile` is included in the root of the project so Railway detects it and use it to build and deploy the app. The environment variables are set directly inside the Railway project dashboard.

# Pages Created
## 1. dashboard
It displays numeric datas from the inventory,
![image](https://github.com/user-attachments/assets/1da4913b-ac45-4ffc-b63d-9e9f8350aea7)


includes: 
- total number of items
- total number of low-stock items
- Items Expiring soon
- Total value from the inventory

Charts:
- Demand Forecasts
- Inventory Levels



## 2. Inventory Management
This page uses MongoDB for storing item data and performs simple CRUD operations
![image](https://github.com/user-attachments/assets/2f2bfa76-f12d-4536-a3db-6585265507cd)



## 3. Ingredients Calculator
This page is dedicated for calculating bulk orders and displays the total price in a few clicks. This also provide unit converters for measurements
![image](https://github.com/user-attachments/assets/84e25c63-a457-4e21-9985-3074477b4caf)



## 4. Local Events
Summarizes Upcoming local events that may affect the shops demands
![image](https://github.com/user-attachments/assets/0df79966-e517-4729-ae26-2c62d67cb2a0)

# Contributors
Members of the group in this project:
- Milkel1 - Ferrer, Michael
- CjonesOveHevun - Mojica, Jerome
- [no Github] - Lastimosa, Samantha Nicole 
