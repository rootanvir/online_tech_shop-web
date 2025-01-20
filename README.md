# Online Tech Shop Web

## Overview
The Online Tech Shop Web is an e-commerce platform built to provide users with a seamless shopping experience for tech products. The system includes features such as user authentication, product catalog management, and a shopping cart. Developed using HTML, CSS, PHP, JavaScript, and JSON, this platform enables secure product browsing, order management, and payment processing.

## Features

### User Features
- **Product Catalog**: Browse a variety of tech products with filtering and searching options.
- **Shopping Cart**: Add/remove products, view cart summary, and adjust quantities.
- **Order Checkout**: Complete purchase through secure checkout and payment options.

### Manager Features

- **Add Product**: Add new tech products to the catalog.
- **Product List**: View, edit, or remove products from the list.
- **Profile**: View and edit the manager’s profile details.

### Admin Features
- **Add Employee**: Add new employee details to the system.
- **Add Product**: Add new tech products to the catalog.
- **Employee List**: View and manage employee records.
- **Product List**: View, edit, or remove products.
- **Customer List**: Access customer profiles and their activities.
- **Sells Info**: Monitor sales data and generate reports.
- **Manage Order**: Process and manage customer orders.
- **Profile**: View and edit the admin’s profile details.



### Authentication System
- **User Authentication**: Login and registration with session-based authentication.

## Technologies Used
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP, JavaScript
- **Database**: MySQL or JSON (for data storage)
- **Authentication**: PHP sessions for login management.

## Installation Guide

### Prerequisites
- **PHP**: Local PHP server setup (XAMPP, WAMP, or custom setup).
- **Database**: MySQL or a similar database for data storage.

### Steps to Install
1. Clone the repository:
   ```bash
   git clone https://github.com/rootanvir/online_tech_shop-web.git
    ```
2. Go to directory
    ```bash
   cd online_tech_shop-web
   ```

3. Set up PHP
   - Install PHP dependencies.

4. Set up Database
   - Import the `online_tech_shop.sql` file into MySQL to create necessary tables (products, users, orders, etc.).


5. Run the PHP Server
   - Place files in the server root (e.g., `htdocs` for XAMPP) and access the application via `localhost`.

## Default Credentials for Testing

| User Type|  username |Password |
|----------|-----------|---------|
| admin    |  2202     | 0011    |
| manager  |  2200     | 0011    |
| customer |           |         |



## Screenshots
- **Product Catalog**
![image](https://github.com/user-attachments/assets/f7dc2ff5-c17b-469d-8452-49be3c8452bc)

- **Admin Dashboard**
- ![image](https://github.com/user-attachments/assets/6046b87f-6ab9-45b1-a6bc-62c3e22258c4)

- **Manager Dashboard**
![image](https://github.com/user-attachments/assets/a14798d2-942c-4b58-a739-757a7b9be082)



## Contributing
Contributions are welcome! Please follow these steps:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-name`).
3. Make your changes and commit.
4. Push changes (`git push origin feature-name`).
5. Open a pull request for review.



## Acknowledgments
Thanks to the open-source community for the tools and libraries used in this project.

## Support
For any issues or questions, please open an issue in the repository or contact the project owner.

