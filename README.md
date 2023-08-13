# Employee Management System (PHP & MySQL)

![Project Logo](./img.png)

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
- [Usage](#usage)
- [Database Schema](#database-schema)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Introduction

The Employee Management System is a college project developed using PHP and MySQL. This project aims to provide a user-friendly web application for managing employee information, tracking attendance, and handling various HR-related tasks efficiently.

## Features

- User Authentication: Secure login and role-based access control for administrators and employees.
- Employee Information: Add, edit, and view employee details, including personal information, contact details, and job history.
- Attendance Tracking: Record and manage employee attendance, generate attendance reports for specific periods.
- Leave Management: Employees can request leaves, and administrators can review, approve, or reject leave requests.
- Salary Management: Calculate and manage employee salaries, view salary history, and generate pay stubs.
- Task Assignment: Assign tasks to employees, track task status, and monitor progress.
- Responsive Design: The user interface is responsive and accessible from various devices.

## Getting Started

Follow these instructions to set up the Employee Management System on your local machine.

### Prerequisites

- Docker


### Installation

1. Clone the repository: `git clone https://github.com/yourusername/employee-management-system.git`
2. Navigate to the project directory: `cd employee-management-system`
3. docker create network minor && docker compose up -d 

## Usage

1. Log in as an administrator or an employee using the provided credentials.
2. Manage employee information, including personal details, contact information, and job history.
3. Record and manage employee attendance, as well as review attendance reports.
4. Handle leave requests, approve or reject requests as an administrator, and track leave balances.
5. Manage employee salaries, view salary history, and generate pay stubs.
6. Assign tasks to employees and monitor task progress.
7. Explore various features of the system and provide feedback for further improvements.

## Database Schema

The database schema consists of several tables, including `employees`, `attendance`, `leave_requests`, `salaries`, and more. Refer to the provided SQL file for a detailed schema description.


## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgments

We extend our appreciation to the PHP and MySQL communities for providing robust tools for web application development. Special thanks to our mentors and contributors for their valuable guidance and support.

---

For any questions or inquiries, feel free to contact us at bishalkarki201@gmail.com We hope the Employee Management System proves to be a valuable asset for managing HR operations effectively!
