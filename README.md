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