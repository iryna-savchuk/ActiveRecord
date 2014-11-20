ActiveRecord
============
This application is aimed to display the list of comments from the table 'comments'. Also, this list should end with the form to add new comment. 
Each comment as an object has the following attributes: id, author and text. The attributes correspond to the fields of table with the same names. 

The application is based on ActiveRecord class that implements ActiveRecord pattern. 
The description of this pattern can be found at https://en.wikipedia.org/wiki/Active_record_pattern

To work with the database, DB class was used which is available at:
https://github.com/colshrapnel/safemysql/blob/master/safemysql.class.php
The mentioned DB class has been modified a bit in order to ensure Singleton pattern to be used for DB connection. 

To make the page more user-friendly and beautiful, Foundation front-end framework was used. For details, please go to: 
http://foundation.zurb.com/docs/

============
Ivko Iryna
20th of November, 2014.
