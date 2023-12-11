
**Overview**: 
we faced the daunting task of integrating RFID technology with Arduino and other 
peripherals. Our initial system required an internet connection to fetch data from 
a central server. However, we developed a code that contains manually added 
balance and status variables that update each time an RFID card is scanned. We 
also incorporated push-buttons and later replaced them with a keypad to enable 
users to enter the number of people and add dynamic amounts. This served as a 
fundamental step to work with internet-connected RFID technology.
The final phase involved combining all system components to create a fully 
functional on-site prototype. Despite encountering several challenges, such as 
analysing website code to ensure compatibility, we overcame them, and the 
result is a reliable, efficient, and revolutionary RFID-based payment system.

**Functionalities**: 
User Registration: The system allows users to create accounts by providing their 
personal information such as name, address, phone number, and email address. 
Once registered, users are issued with RFID cards, which they can use to make 
payments. 

**Payment** **Processing**: When a customer wants to make a payment, they present 
their RFID card to the RFID reader, which reads the data on the card and sends it 
to the server for processing. The server deducts the amount from the customer's 
account balance and updates the database. Balance Enquiry: The system allows 
customers to check their account balance by presenting their RFID card to the 
RFID reader. The reader reads the data on the card and displays the account 
balance on the LCD. 
**Transaction** **History**: 
The system allows customers to view their transaction history by logging into their 
accounts. The system retrieves the transaction history from the database and 
displays it to the customer. Top-up: Customers can top-up their accounts by 
logging into their accounts and making a payment using a debit or credit card. The 
system deducts the amount from the customer's card and updates the account 
balance. Security: 
The system uses encryption to protect customer data and prevent unauthorized 
access. The RFID cards are also encrypted to prevent cloning and unauthorized 
use.
**Hardware** **Components**: 
The hardware components used in this project include an Arduino Uno, Ethernet 
shield, 12C module, and RFID reader. The RFID reader is used to read the 
information stored on the RFID tag. The Arduino Uno is used to process the 
information and communicate with the Ethernet shield to send data to the server. 

**Software** **Components**: 
The software components used in this project include PHP, MySQL, HTML, CSS, 
and JavaScript. PHP is used for server-side scripting, MySQL is used for database 
management, 
HTML and CSS are used for designing the user interface, and JavaScript is used for 
client-side scripting.

**Functionality**: 
The RFID-based payment system has several functionalities. Firstly, users can 
register their RFID tag in the system by providing their personal details such as 
name, address, and contact information. This information is stored in the MySQL 
database. Secondly, users can add credit to their RFID tag by using a payment 
gateway. The payment gateway is integrated with the system and allows users to 
add credit using various payment methods such as credit card, debit card, and net 
banking. 
The credit added by the user is also stored in the MySQL database. Thirdly, users 
can use their RFID tag to make payments at various outlets in the fun park. When 
a user makes a payment, the RFID reader reads the information stored on the 
RFID tag and sends it to the Arduino Uno. 
The Arduino Uno then communicates with the Ethernet shield to send data to the 
server. The server verifies the payment and deducts the amount from the user's
credit balance stored in the MySQL database.
