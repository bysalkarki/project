# Employee Management System

The Employee Management System is a web application designed to facilitate the management of departments and employees within an organization. This system allows users to register, login, and perform CRUD operations on departments and employees.

## Features

- User Authentication: Users can register and login to access the system.
- Department Management: Users can perform CRUD operations on departments.
- Employee Management: Users can perform CRUD operations on employees and associate them with departments.

## Technologies Used

- Frontend: HTML, CSS, JavaScript
- Backend: Php
- Database: mysql

## Installation

1. Clone the repository:

    ```
    git clone https://github.com/bysalkarki/project
    ```

2. Navigate to the project directory:

    ```
    cd employee-management-system
    ```

3. run docker:

    ```
    docker compose up --build
    ```

4. Set up the environment variables:
    - Create a `.env` file in the `src` directory.
    - update it according to `.env`:


6. Access the application at `http://localhost:8088`.

## Usage

1. Register a new account or login with existing credentials.
2. Once logged in, you will be redirected to the dashboard.
3. From the dashboard, you can manage departments and employees.
    - **Departments**:
        - Create a new department.
        - Read existing departments.
        - Update department details.
        - Delete a department.
    - **Employees**:
        - Create a new employee and associate them with a department.
        - Read existing employees.
        - Update employee details.
        - Delete an employee.

## Contributing

Contributions are welcome! Feel free to open issues or submit pull requests.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

For any inquiries, please contact [bishalkarki201@gmail.com](mailto:bishalkarki201@gmail.com).

---

This README provides a brief overview of the Employee Management System, including installation instructions, usage guidelines, and other relevant information. Users can refer to this document to understand how to set up and utilize the system effectively.
