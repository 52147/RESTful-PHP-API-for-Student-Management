# RESTful PHP API for Student Management

A simple RESTful API built in PHP that serves data for courses and students. The API fetches and delivers student and course data in a structured JSON format, providing a scalable and efficient way to manage and retrieve educational data.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

## Features

- **Dynamic Data Retrieval**: Fetches specific student or course data based on query parameters.
- **JSON Response**: Efficiently delivers data in a structured JSON format for easy frontend integration.
- **Secure Database Access**: Uses prepared statements for database querying, ensuring secure data retrieval.

## Installation

### Requirements:

- PHP 
- MySQL 
- Any web server 

### Steps:

1. Clone this repository:
    ```bash
    git clone https://github.com/52147/RESTful-PHP-API-for-Student-Management
    ```

2. Import the SQL tables from `database.sql` into your MySQL server.
3. Configure the `database.php` file with your database connection details.
4. Deploy on your preferred web server and ensure the PHP module is enabled.

## Usage

To retrieve students of a specific course:
```
GET /rest.php?format=json&action=students&course=[courseID]
```
**Example:**
```
GET /rest.php?format=json&action=students&course=cs602
```


## Testing

1. Use tools like Postman or CURL to test the endpoints.
2. Ensure error handling works by testing with incorrect or missing parameters.

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License. See `LICENSE` for more details.
