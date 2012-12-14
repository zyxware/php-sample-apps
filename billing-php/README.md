## Billing System

A PHP based billing system.

Billing system developed as a sample application. The various features included
with the program are.
  1. Drupal coding standards.
  2. Doxygen documentation system.
  3. Single point of entry.
  4. PDO database connect.
  5. Savant based templating system
  6. Directory structure.
  7. GIT version control system

### 1. Drupal coding standards.
  To improve readability and uniformity of the code, the coding standard adopted
  was according to the Drupal coding standards described at

                       http://drupal.org/coding-standards

### 2. Doxygen documentation system.
  Doxygen is a tool used to automate the documentation generation process. It
  allows documentation of the code within the code file itself and later
  generates the documentation from these comments. This allows up to keep the
  documentation up-to-date with the code without much trouble.

### 3. Single point of entry.
  Single point of entry allows all request to various pages to be processed by
  a single file. This permits the file to act as a controller which controls
  what files are accessed by which users etc.
  For example:
    http://example.com/?p=something
    Would call the corresponding handler to handle and process the request of p.

### 4. PDO database connect.
  PDO database connect allows us to abstract the type of database used. Database
  specific commands are handled by the PDO. The programmer need not bother about
  the type of database used, or porting code to various databases.

### 5. Savant based templating system.
  Due to the savant based templating system, we could sucessfully seperate the
  theme and view files from the core files. This provides ease of theming and
  flexibility of design.

### 6. Directory structure.
  The directory structure seperates the various files into categories, making it
  easy to locate files and perform modification and maintainance of code.
  Documentation is maintained in a seperate documentation directory.

### 7. Git version control system.
  The git version control system was used to maintain the code.

The project was designed and developed at [Zyxware Technologies](http://www.zyxware.com/) under the guidance
of Vimal Joseph.


## Steps to install

1. Copy the Config.php.sample as config.php
2. Place the configurations details within it.
3. Run install.php.

