# whyoscafe_pos
Mock PoS website for school project.
This is a simple inventory system developed by
3 members in this group. Built mainly using PHP and MongoDB.
It allows users to add items and view dashboards dsiplaying inventory records.

Deployed web-link:
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
</table>
 



# Pages Created
## 1. dashbaord
It displays numeric datas from the inventory,
![image](https://github.com/user-attachments/assets/c5c56112-8277-4834-8acc-76bc1d42ee25)
consists of: 
- total number of items
- total number of low-stock items
- Items Expiring soon
- Total value from the inventory

Charts:
- <b>[Not working]</b> Demand Forecasts
- Inventory Levels



## 2. Inventory Management
This page uses MongoDB for storing item data and performs simple CRUD operations

## 3. Ingredients Calculator
This page is dedicated for calculating bulk orders and displays the total price in a few clicks. This also provide unit converters for measurements

## 4. Local Events
Summarizes Upcoming local events that may affect the shops demands
