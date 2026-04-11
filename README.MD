# Diva Buildcom

Premium multi-page construction company website built for a WPL mini project using `HTML`, `CSS`, `JavaScript`, `PHP`, and `MySQL` on Ubuntu XAMPP.

## What’s Included

- Five implemented pages: Home, About, Services, Careers, and Contact
- Shared PHP layout structure with reusable includes
- Clean custom CSS and JavaScript instead of serving the raw Stitch/Tailwind exports
- Smooth professional animations for reveals, counters, sticky header, and mobile navigation
- Contact inquiry form with MySQL storage
- Careers application form with resume upload and MySQL storage
- Flash success/error messages after form submission
- MySQL schema for XAMPP MariaDB

## Project Structure

```text
/opt/lampp/htdocs/DivaBuildCom
├── about.php
├── careers.php
├── contact.php
├── index.php
├── services.php
├── assets/
│   ├── css/styles.css
│   ├── js/main.js
│   └── uploads/resumes/
├── database/schema.sql
├── handlers/
│   ├── submit_application.php
│   └── submit_inquiry.php
├── includes/
│   ├── config.php
│   ├── data.php
│   ├── db.php
│   ├── footer.php
│   ├── header.php
│   └── helpers.php
└── resources/
```

## Local XAMPP Setup on Ubuntu

1. Make sure Apache and MySQL are running in XAMPP.
2. Keep the project in:
   `/opt/lampp/htdocs/DivaBuildCom`
3. Create the database and tables:

```bash
/opt/lampp/bin/mysql -u root < /opt/lampp/htdocs/DivaBuildCom/database/schema.sql
```

4. Open the site in the browser:

```text
http://localhost/DivaBuildCom/
```

## Database Configuration

The local defaults are already set in [`includes/config.php`](/opt/lampp/htdocs/DivaBuildCom/includes/config.php):

- Host: `localhost`
- Database: `divabuildcom`
- User: `root`
- Password: empty string

If your local MySQL root user has a password, update the `pass` value in [`includes/config.php`](/opt/lampp/htdocs/DivaBuildCom/includes/config.php).

## Resume Uploads

- Upload path: [`assets/uploads/resumes`](/opt/lampp/htdocs/DivaBuildCom/assets/uploads/resumes)
- Allowed formats: `PDF`, `DOC`, `DOCX`
- Max size: `5 MB`

If Apache cannot write to the uploads folder, first try:

```bash
chmod -R 775 /opt/lampp/htdocs/DivaBuildCom/assets/uploads/resumes
```

If needed for your Apache user:

```bash
sudo chown -R daemon:daemon /opt/lampp/htdocs/DivaBuildCom/assets/uploads/resumes
```

Use the ownership command only if your local XAMPP Apache process actually runs as `daemon`.

For local-only XAMPP setups where Apache still cannot write after that, a temporary fallback is:

```bash
chmod 777 /opt/lampp/htdocs/DivaBuildCom/assets/uploads/resumes
```

That is acceptable for local development, but tighter permissions are better for deployment.

## Form Storage

### `inquiries`

Stores Contact page submissions:

- `full_name`
- `phone`
- `email`
- `project_details`
- `ip_address`
- `user_agent`
- `created_at`

### `applicants`

Stores Careers page submissions:

- `full_name`
- `email`
- `phone`
- `target_position`
- `resume_original_name`
- `resume_stored_name`
- `resume_path`
- `message`
- `ip_address`
- `user_agent`
- `created_at`

## Development Notes

- The frontend was rebuilt cleanly from the supplied Stitch designs and screenshots.
- Some content imagery still uses remote image URLs derived from the exported UI code because only the design PNGs were available locally.
- The `Projects` navigation item currently links to the homepage projects section because no separate projects page design was provided.

## Useful Checks

Run PHP syntax checks:

```bash
/opt/lampp/bin/php -l /opt/lampp/htdocs/DivaBuildCom/index.php
/opt/lampp/bin/php -l /opt/lampp/htdocs/DivaBuildCom/about.php
/opt/lampp/bin/php -l /opt/lampp/htdocs/DivaBuildCom/services.php
/opt/lampp/bin/php -l /opt/lampp/htdocs/DivaBuildCom/careers.php
/opt/lampp/bin/php -l /opt/lampp/htdocs/DivaBuildCom/contact.php
```

## Later Public Hosting Checklist

- Replace remote placeholder/reference imagery with owned optimized assets
- Move database credentials into environment-specific configuration
- Enable HTTPS
- Set stronger production file permissions
- Add a production mail/CRM workflow if form notifications are needed
