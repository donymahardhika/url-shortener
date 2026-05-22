# URL Shortener

This project was created to solve the difficulty of remembering long URLs. With this URL Shortener, URLs become simpler and easier to recall because short URLs can be customized freely.

## Features
- Simple and responsive interface  
- Secure login page for better protection  
- Customizable short URL names  
- QR Code generator with custom logo support  
- Basic click analytics  
- Anti-bot protection  

## Requirements
- PHP 7.2.34  
- MySQL / MariaDB  

## Dependencies
- QR Code Generator: [phpqrcode](https://sourceforge.net/projects/phpqrcode/)  

## Installation
1. Clone this repository: git clone https://github.com/donymahardhika/url-shortener.git
2. Configure database connection in config.php.
3. Import SQL schema into MySQL/MariaDB.
4. Run the project on a PHP server (e.g., Apache, Nginx).

## Usage
- Access the index.php to create/manage short URLs.
- User : admin | password : admin123
- Input a long URL and custom short name.
- Generate QR Code with custom logo.
- Track click analytics via dashboard.

## Configuration
- Database settings in config.php.
- QR Code logo path configurable in /assets/your-logo.png (Recommended resolution: 1000 x 1000 px).

## Folder Structure
url-shortener/
├── assets/
│   └── your-logo.png
├── libs/
│   └── phpqrcode/
│       ├── qrlib.php
│       └── other-library-files...
├── qrcodes/
│   └── (generated QR code images stored here)
├── .htaccess
├── check_availability.php
├── config.php
├── index.php
├── LICENSE
├── login.php
└── README.md
├── redirect.php


## Screenshots

  <table>
    <!-- Baris 1 -->
    <tr>
      <td>
        <figure>
          <img width="457" height="946" alt="Login Page" src="https://github.com/user-attachments/assets/623ebb28-2a8f-4c8b-9ea5-331e4b4f0fa7" /><br>
          <figcaption>Login Page</figcaption>
        </figure>
      </td>
      <td>
        <figure>
          <img width="457" height="946" alt="Home Page" src="https://github.com/user-attachments/assets/1b826111-af5e-45e9-9b7d-89b1c321a2e1" /><br>
          <figcaption>Home Page</figcaption>
        </figure>
      </td>
      <td>
        <figure>
          <img width="457" height="946" alt="Case Sensitive - Available" src="https://github.com/user-attachments/assets/b13edf2c-a125-4538-b89f-db9341621bf0" /><br>
          <figcaption>Case Sensitive - Available</figcaption>
        </figure>
      </td>
    </tr>
    <!-- Baris 2 -->
    <tr>
      <td>
        <figure>
          <img width="457" height="946" alt="Case Sensitive - Taken" src="https://github.com/user-attachments/assets/1072e8b5-5464-4f80-bcc0-a46e2ea246d0" /><br>
          <figcaption>Case Sensitive - Taken</figcaption>
        </figure>
      </td>
      <td>
        <figure>
         <img width="457" height="946" alt="Process - Input" src="https://github.com/user-attachments/assets/77e65c83-a4c7-4ff2-961c-17919cbb6032" /><br>
          <figcaption>Process - Input</figcaption>
        </figure>
      </td>
      <td>
        <figure>
          <img width="457" height="946" alt="Process - Success" src="https://github.com/user-attachments/assets/ffd171f7-fcd6-4d4f-b76b-c26b8853c02b" /><br>
          <figcaption>Process - Success</figcaption>
        </figure>
      </td>
    </tr>
    <!-- Baris 3 -->
    <tr>
      <td>
        <figure>
          <img width="457" height="946" alt="Process - Copied" src="https://github.com/user-attachments/assets/87210353-fdc0-4597-94af-c808d22ece08" /><br>
          <figcaption>Process - Copied</figcaption>
        </figure>
      </td>
      <td>
        <figure>
          <img width="457" height="946" alt="Home Page - View QR Code" src="https://github.com/user-attachments/assets/d29f05ef-4fdb-4151-9674-879500b5aaec" /><br>
          <figcaption>Home Page - View QR Code</figcaption>
        </figure>
      </td>
      <td>
      </td>
    </tr>
  </table>


## Contributing
Contributions are welcome!
1. Fork the repository
2. Create a new branch (git checkout -b feature-name)
3. Commit changes (git commit -m "Add feature")
4. Push to branch (git push origin feature-name)
5. Open a Pull Request

## License
This project is licensed under the MIT License.

## Acknowledgements
- phpqrcode for QR Code generation
- Inspiration from common URL shortener services

## Roadmap
- Advanced analytics (location, device, referrer)
- Admin dashboard for managing links
- REST API for external integrations
- Docker support for easier deploment
- OAuth login (Google, Github) integration
