# whyoscafe_pos
Mock PoS website for school project.
This is a simple inventory system developed by
3 members in this group. Built mainly using PHP and MongoDB.
It allows users to add items and view dashboards dsiplaying inventory records.

Deployed web-link:
https://whyoscafepos-production.up.railway.app/

<div>
  Deployment: <a href="https://railway.com/">Railway.com</a>
</div>
<div>
  Database: <a href="https://www.mongodb.com" >MongoDB</a> via Atlas
</div>



# 4 Pages created
## 1. dashbaord
It displays numeric datas from the inventory,
consists of: 
- total number of items
- total number of low-stock items
- Items Expiring soon
- Total value from the inventory

## 2. Inventory Management
This page uses MongoDB for storing item data and performs simple CRUD operations

## 3. Ingredients Calculator
This page is dedicated for calculating bulk orders and displays the total price in a few clicks. This also provide unit converters for measurements

## 4. Local Events
Summarizes Upcoming local events that may affect the shops demands
