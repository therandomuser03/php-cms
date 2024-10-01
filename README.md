<!-- for($i=1; $i<=10; $i++) {
echo '<li><a href="index.php?pagecode='.$i.'">'.$i.'</a></li>';
} -->

<!-- Project documentation -->





# Project Directory Structure

```bash
cms_2/                                          # Root directory
│
├── backend/                                    # Backend functionalities
│   ├── admin/
│   │   ├── dashboard.php                       # Admin dashboard
│   │   ├── login.php                           # Admin login
│   │   ├── logout.php                          # Logout functionality
│   │   └── register.php                        # Admin registration
│   │
│   ├── gallery/                                # Gallery management system
│   │   ├── uploads/
│   │   │   └── images/                         # Image uploads directory
│   │   │       └── (image files)               # [e.g., page-title.jpg]
│   │   ├── add_image.php                       # Add new image form
│   │   ├── edit_image.php                      # Edit existing images
│   │   ├── list_image.php                      # List existing images
│   │   ├── upload_image.php                    # Handle image uploads
│   │   └── view_image.php                      # View image functionality
│   │
│   ├── includes/                               # Commonly used includes
│   │   ├── assets/
│   │   │   ├── css/                            # CSS files
│   │   │   ├── fonts/                          # Font files
│   │   │   ├── images/                         # Images for the UI
│   │   │   └── js/                             # JavaScript files
│   │   ├── footer.php                          # Footer for the pages
│   │   ├── header.php                          # Header for the pages
│   │   ├── pagefooter.php                      # Footer for specific pages
│   │   ├── pageheader.php                      # Header for specific pages
│   │   └── sidebar.php                         # Sidebar for the pages
│   │
│   ├── pages/                                  # Pages management system
│   │   ├── pages_add.php                       # Add new page form
│   │   ├── pages_edit.php                      # Edit existing pages
│   │   └── pages.php                           # List and manage pages
│   │
│   ├── public/                                 # Public-facing content
│   │   └── index.php                           # Homepage of the public website
│   │
│   └── users/                                  # User management system
│       ├── manage_users.php                    # List and manage users
│       ├── users_add.php                       # Add new user form
│       └── users_edit.php                      # Edit existing users
│
├── config/                                     # Configuration files
│   ├── 404.html                                # 404 error page
│   ├── cms_2.sql                               # SQL file for database structure
│   ├── config.php                              # Main configuration file
│   ├── database.php                            # Database connection settings
│   ├── functions.php                           # Commonly used functions
│   └── gallery.php                             # Gallery functionality
│
├── frontend/                                   # Frontend components
│   ├── contact_form.php                        # Contact form page
│   ├── index.php                               # Frontend homepage
│   └── process_contact.php                     # Handle contact form submissions
│
└── README.md                                   # Project overview (this file)


```

<!-- 


cms_2/                       # Root directory
│
├── config/                  # Configuration files
│   └── db.php               # Database connection script
│
├── public/                  # Publicly accessible directory
│   ├── index.php            # Entry point of the application (dashboard)
│   ├── login.php            # User login page
│   ├── register.php         # User registration page (if required)
│   ├── logout.php           # User logout script
│   ├── content/             # Content management related pages
│   │   ├── create_post.php  # Form to create a new post
│   │   ├── edit_post.php    # Form to edit a post
│   │   ├── view_post.php    # View individual post details
│   │   ├── list_posts.php   # List all posts
│   │
│   ├── gallery/             # Gallery management related pages
│   │   ├── add_image.php    # Upload new image
│   │   ├── edit_image.php   # Edit image details
│   │   ├── list_gallery.php # List all gallery items
│   │   ├── view_image.php   # View image details
│   │
│   ├── admin/               # Admin panel
│       ├── dashboard.php    # Admin dashboard
│       ├── manage_users.php # Manage user roles & access
│
├── assets/                  # Static resources (CSS, JS, Images)
│   ├── css/                 # Stylesheets
│   │   └── style.css        # Main stylesheet
│   ├── js/                  # JavaScript files
│   │   └── script.js        # Custom scripts
│   └── images/              # Image uploads (e.g. from gallery)
│
├── uploads/                 # Uploaded content storage
│   ├── images/              # Uploaded images
│
├── includes/                # Common components or reusable templates
│   ├── header.php           # Common header for all pages
│   ├── footer.php           # Common footer for all pages
│   ├── sidebar.php          # Admin or user sidebar
│
├── functions/               # Helper functions
│   ├── auth.php             # Authentication-related functions (login, access control)
│   ├── content.php          # Functions to handle content operations
│   ├── gallery.php          # Functions for gallery-related operations
│   └── validation.php       # Form validation logic
│
├── sql/                     # SQL-related files
│   ├── cms_2.sql            # SQL file for table structure (to setup or export database)
│
└── README.md                # Project documentation  -->




<!-- File Structure Breakdown:
1. config/:
- db.php: Contains your database connection details.
2. public/:
- index.php: The main entry point, usually the homepage or dashboard.
- content/: Contains pages for managing CMS posts, including creating, editing, viewing, and listing posts.
- gallery/: Manages image uploads, gallery listings, and image viewing.
- admin/: Admin-specific functionalities like managing users, roles, and access permissions.
3. assets/:
- css/: Contains stylesheets. For example, style.css for the main styles of the site.
- js/: Stores JavaScript files, such as script.js, for adding interactivity to the CMS.
- images/: May contain static images that don't change often, such as logos or icons.
4. uploads/:
- images/: Directory for storing user-uploaded images (e.g., blog post images or gallery images).
5. includes/:
- header.php: Shared header for all the pages (could contain navigation).
- footer.php: Shared footer (common across pages).
sidebar.php: For admin or user navigation, depending on their role.
6. functions/:
- auth.php: Contains authentication and user role validation functions.
- content.php: Functions for CRUD (Create, Read, Update, Delete) operations on posts.
- gallery.php: Functions for managing the gallery, image uploads, and validations.
- validation.php: General form validation for user input across different forms.
7. sql/:
cms_2.sql: The SQL file to set up your database. It includes the tables and initial data.
8. README.md:
Documentation to explain the project, setup instructions, and any dependencies.
------------------------------------
Optional Enhancements:
- logs/: For storing error or access logs (if needed for debugging).
- tests/: If you're integrating unit tests for various modules or functions. -->





<!-- --------------------------------------------- -->

<!-- <li class="menu-item-has-children">
                                <a href="#">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="index-2.html">Home Default</a></li>
                                    <li><a href="index-3.html">Home style 2</a></li>
                                    <li><a href="index-4.html">Home style 3</a></li>
                                </ul>
                            </li>
                            <li><a href="about.html">About</a></li>
                            <li class="menu-item-has-children">
                                <a href="#">Pages</a>
                                <ul class="sub-menu">
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="testimonials.html">Testimonials</a></li>
                                    <li><a href="testimonials-s2.html">Testimonials style 2</a></li>
                                    <li><a href="team.html">Team</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="shop-single.html">Shop single</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Services</a>
                                <ul class="sub-menu">
                                    <li><a href="services.html">Services</a></li>
                                    <li><a href="services-s2.html">Services style 2</a></li>
                                    <li><a href="service-single.html">Mechanical Engineering</a></li>
                                    <li><a href="oil-gas.html">Oil And Gas</a></li>
                                    <li><a href="power-energy.html">Power And Energy</a></li>
                                    <li><a href="sanitary-plumbing.html">Sanitary & Plumbing</a></li>
                                    <li><a href="electrical-power.html">Electrical Power</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Projects</a>
                                <ul class="sub-menu">
                                    <li><a href="portfolio.html">Projects</a></li>
                                    <li><a href="portfolio-s2.html">Projects style 2</a></li>
                                    <li><a href="project-single.html">Project single</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog-left-sidebar.html">Blog left sidebar</a></li>
                                    <li><a href="blog-fullwidth.html">Blog full width</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#Level3">Blog single</a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-single.html">Blog single</a></li>
                                            <li><a href="blog-single-left-sidebar.html">Blog single left sidebar</a></li>
                                            <li><a href="blog-single-fullwidth.html">Blog single full width</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li> -->