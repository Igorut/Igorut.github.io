Random DataBase generator

Simple usage 

1. Edit DataBase params in dist/DB/Params/Params.php
2. Just run index.php
3. Profit!

You can change:
1. Range of random date of birth here -> dist/RandomGenerator/RandomGenerator.php -> __construct -> beginDate, endDate
2. Characters for random initials here -> dist/RandomGenerator/RandomGenerator.php -> randomInitials() -> $characters
3. List of surnames here -> dist/StaffInformation/Surname/surnames.txt (Look into SunameGenerator.php, maybe, it's need to be changed by you!) 
4. List of departments here -> dist/Departments/departments.txt 
5. And correct something in index.php for your language

I would be very grateful if you want to help optimize / make a little clean the code!