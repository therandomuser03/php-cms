<!-- for($i=1; $i<=10; $i++) {
echo '<li><a href="index.php?pagecode='.$i.'">'.$i.'</a></li>';
} -->

<!-- Project documentation -->


#### This is a project I have created using SQL and PHP. This is a CMS (Content Management System) which is similar to Wordpress, Joomla, etc., with the integration of TinyMCE, a WYSIWYG editor. 


# Project Directory Structure

```bash
cms_2/                                          # Root directory
│
├── backend/                                    # Backend functionalities
│   ├── admin/                                  # Admin functionalities
│   │   ├── dashboard.php                       # Admin dashboard page
│   │   ├── index.php                           # Admin login page
│   │   ├── logout.php                          # Admin logout functionality
│   │   └── register.php                        # Admin registration page
│   │
│   ├── gallery/                                # Gallery management system
│   │   ├── uploads/
│   │   │   └── images/                         # Directory for uploaded images
│   │   │       └── (image files)               # Uploaded image files (e.g., page-title.jpg)
│   │   ├── delete_image.php                    # Delete image functionality
│   │   ├── gallery_image.php                   # Form to view existing images
│   │   ├── gallery_image2.php                  # Form to  add new images and edit existing images
│   │   ├── toggle_display.php                  # Toggle image visibility
│   │   └── upload_image.php                    # Handle image uploads
│   │
│   ├── includes/                               # Common reusable components
│   │   ├── assets/
│   │   │   ├── css/                            # Stylesheets (CSS files)
│   │   │   ├── fonts/                          # Font files for the UI
│   │   │   ├── images/                         # UI-related image assets
│   │   │   └── js/                             # JavaScript files for the frontend
│   │   ├── footer.php                          # General footer include file
│   │   ├── header.php                          # General header include file
│   │   ├── pagefooter.php                      # Footer for specific pages
│   │   └── pageheader.php                      # Header for specific pages
│   │
│   ├── mails/                                  # Mail management system
│   │   ├── check_mails.php                     # View and manage received mails
│   │   ├── delete_mails.php                    # Delete mail functionality
│   │   └── view_mail.php                       # View mail details
│   │
│   ├── pages/                                  # Page management system
│   │   ├── pages_add.php                       # Form to add new pages
│   │   ├── pages_delete.php                    # Delete page functionality
│   │   ├── pages_edit.php                      # Form to edit existing pages
│   │   └── pages.php                           # List and manage all pages
│   │
│   └── users/                                  # User management system
│       ├── manage_users.php                    # List and manage users
│       ├── users_add.php                       # Form to add new users
│       └── users_edit.php                      # Form to edit existing users
│
├── config/                                     # Configuration files
│   ├── 404.html                                # Custom 404 error page
│   ├── cms_2.sql                               # SQL file for database schema
│   ├── config.php                              # Main configuration file
│   ├── database.php                            # Database connection settings
│   ├── functions.php                           # Utility functions used across the project
│   └── gallery.php                             # Gallery-related functions
│
├── frontend/                                   # Frontend components
│   ├── contact_form.php                        # Contact form page
│   ├── index.php                               # Main homepage of the frontend
│   └── process_contact.php                     # Process and handle contact form submissions
│
└── README.md                                   # Project overview (this file)


```


<!-- File Structure Breakdown:
.
.
.
.
8. README.md:
Documentation to explain the project, setup instructions, and any dependencies.
------------------------------------
Optional Enhancements:
- logs/: For storing error or access logs (if needed for debugging).
- tests/: If you're integrating unit tests for various modules or functions. -->

