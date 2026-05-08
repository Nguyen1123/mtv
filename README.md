# Solar Energy Website

Complete responsive website for solar energy products and services with admin management panel.

## Features

✨ **Modern, Responsive Design**
- Mobile-friendly interface
- Green energy theme (#27ae60)
- Smooth animations and transitions
- **Clean URLs** (e.g., `/san-pham` instead of `/products.php`)

🛠️ **Full Admin Panel**
- Manage products with image uploads
- Create and edit blog posts
- Showcase solar projects
- View contact form submissions
- User-friendly dashboard

📱 **Public Pages**
- Homepage with featured content
- Product catalog
- Project showcase
- News/blog section
- Contact form

🔐 **Security**
- Admin login with password hashing
- Session-based authentication
- Input sanitization

📊 **No Database Required**
- JSON-based data storage
- Perfect for shared hosting
- Easy to backup and migrate

## Technology Stack

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, CSS3, Vanilla JavaScript
- **Data Storage**: JSON files
- **Server**: Apache/Nginx with PHP support

## Project Structure

```
web_mtv/
├── admin/                  # Admin management pages
│   ├── login.php          # Admin login
│   ├── dashboard.php      # Admin dashboard
│   ├── products.php       # Manage products
│   ├── projects.php       # Manage projects
│   └── posts.php          # Manage blog posts
├── config/
│   └── db.php             # JSON data functions
├── includes/
│   ├── header.php         # Navigation header
│   └── footer.php         # Page footer
├── assets/
│   ├── css/style.css      # Website styling
│   └── js/script.js       # Client-side scripts
├── data/                  # JSON data files
│   ├── admin.json
│   ├── products.json
│   ├── projects.json
│   ├── posts.json
│   └── contacts.json
├── uploads/               # Product/project images
├── index.php              # Homepage
├── products.php           # Product page
├── projects.php           # Projects page
├── posts.php              # News/blog page
├── contact.php            # Contact page
└── DEPLOYMENT.md          # Deployment guide
```

## Quick Start

1. **Download/Clone** the project
2. **Upload** to web server
3. **Set permissions**:
   - `/data/` → 777
   - `/uploads/` → 777
4. **Visit** your domain
5. **Login**: username: `admin` | password: `admin123`

## Admin Credentials

- **Username**: admin
- **Password**: admin123

⚠️ Change password after first login!

## Data Management

All website content is stored in JSON files in the `/data/` folder:

- `admin.json` - Admin users
- `products.json` - Product catalog
- `projects.json` - Solar projects
- `posts.json` - Blog posts
- `contacts.json` - Contact submissions

## Image Upload

- Products, projects, and posts support image uploads
- Images are saved to `/uploads/` folder
- Supported formats: JPG, PNG, GIF, WebP
- Recommended size: up to 5MB

## Deployment

For detailed deployment instructions, see [DEPLOYMENT.md](DEPLOYMENT.md)

### On AwardSpace

1. Upload files to `/public_html/` via FTP
2. Set `/data/` and `/uploads/` permissions to 777
3. Access via cPanel File Manager if needed
4. Visit domain to start using

## Browser Compatibility

- Chrome/Edge: ✅ Full support
- Firefox: ✅ Full support
- Safari: ✅ Full support
- IE 11: ⚠️ Limited support

## Performance

- No database queries = fast load times
- Lightweight codebase
- Optimized CSS and JavaScript
- Responsive images

## Customization

### Changing Colors

Edit `/assets/css/style.css`:
- Primary color: `#27ae60` (green)
- Accent: `#2ecc71`
- Text: `#333`

### Adding Menu Items

Edit `/includes/header.php` to add navigation links

### Modifying Content

Edit homepage in `/index.php` or use admin panel

## Security Notes

1. **Backup** `/data/` folder regularly
2. **Use HTTPS** for admin login
3. **Strong password** for admin account
4. **Disable directory listing** in `.htaccess`

## Troubleshooting

**Permission denied**: Set `/data/` and `/uploads/` to 777

**Images not showing**: Check `/uploads/` exists and has 777 permissions

**Admin login fails**: Clear browser cache, verify `/data/admin.json` exists

## License

Open source - free to use and modify

## Support

For issues, check [DEPLOYMENT.md](DEPLOYMENT.md) troubleshooting section or contact your hosting provider.

---

**Made with ❤️ for solar energy**
