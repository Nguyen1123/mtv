# Solar Energy Website - Deployment Guide

## Quick Start

### Prerequisites
- PHP 7.4+ (with sessions enabled)
- Web server (Apache/Nginx)
- FTP or File Manager access to hosting

### Installation Steps

#### 1. Upload Files to Server
Upload all files from `/web_mtv/` to `/public_html/` (or appropriate root directory)

```
Structure after upload:
/public_html/
├── admin/
├── config/
├── includes/
├── assets/
├── data/
├── uploads/
├── index.php
└── ...other pages
```

#### 2. Set Folder Permissions

On your hosting control panel or via SSH:
```bash
# Make data folder writable for JSON files
chmod 777 /public_html/data/

# Make uploads folder writable for images
chmod 777 /public_html/uploads/
```

**Via cPanel File Manager:**
- Right-click `/data/` folder → Change Permissions → Select "777"
- Right-click `/uploads/` folder → Change Permissions → Select "777"

## Website URLs

### Public Pages

- **Homepage**: `http://yourdomain.com/`
- **Products**: `http://yourdomain.com/san-pham` (previously `/products.php`)
- **Projects**: `http://yourdomain.com/du-an` (previously `/projects.php`)
- **News/Blog**: `http://yourdomain.com/tin-tuc` (previously `/posts.php`)
- **Contact**: `http://yourdomain.com/lien-he` (previously `/contact.php`)
- **Admin Login**: `http://yourdomain.com/admin/login.php`

### Clean URLs

The website uses clean URLs (without `.php` extensions) for better SEO and user experience. This is handled automatically by the `.htaccess` file with URL rewriting.

#### 3. Verify Installation

Visit your website:
- **Homepage**: `http://yourdomain.com/`
- **Admin Panel**: `http://yourdomain.com/admin/login.php`

#### 4. Login to Admin Panel

Credentials:
- **Username**: admin
- **Password**: admin123

⚠️ **IMPORTANT**: Change password immediately after first login!

### Data Management

#### Adding Products
1. Login to admin panel
2. Navigate to "Quản lý sản phẩm" (Products)
3. Click "Thêm sản phẩm mới" (Add new product)
4. Fill in details and upload image
5. Click "Lưu" (Save)

#### Adding Projects
1. Login to admin panel
2. Navigate to "Quản lý dự án" (Projects)
3. Click "Thêm dự án" (Add project)
4. Fill in details and upload image
5. Click "Lưu" (Save)

#### Managing Blog Posts
1. Login to admin panel
2. Navigate to "Quản lý bài viết" (Posts)
3. Add/edit/delete blog posts
4. Posts appear on "Tin tức" (News) page

#### Viewing Contact Messages
1. Login to admin panel
2. Check "Dashboard" for recent contacts
3. Contact messages are saved automatically when submitted via contact form

### JSON Data Files

The website uses JSON files instead of database:

- **admin.json** - Admin login credentials
- **products.json** - Product catalog
- **projects.json** - Solar projects
- **posts.json** - Blog posts
- **contacts.json** - Contact form submissions

All files are in `/data/` folder.

### Image Upload

Images are automatically saved to `/uploads/` folder when:
- Adding/editing products
- Adding/editing projects
- Adding/editing blog posts

Supported formats: JPG, PNG, GIF, WebP (up to 5MB recommended)

### Troubleshooting

#### Error: Permission Denied Writing to /data/
**Solution**: Set `/data/` folder permissions to 777

#### Error: Images not displaying
**Solution**: 
1. Check `/uploads/` folder exists and has 777 permissions
2. Verify image file names in admin interface
3. Images must be in `/uploads/` folder

#### Admin login not working
**Solution**:
1. Clear browser cookies/cache
2. Verify `/data/admin.json` exists
3. Check session is enabled in PHP

#### Lost all data after uploading
**Solution**: Don't delete `/data/` folder - it contains all data!

### Security Notes

1. **Change admin password** immediately after first login
2. **Backup `/data/` folder** regularly - it contains all website content
3. **Disable directory listing** in `.htaccess` (for Apache)
4. **Use HTTPS** whenever possible (ask hosting provider)

### Support

For issues or questions:
1. Check troubleshooting section above
2. Verify file/folder permissions
3. Ensure PHP 7.4+ is enabled
4. Contact hosting provider if problems persist

---

**Website Features:**
- ✅ Responsive design (mobile-friendly)
- ✅ Admin panel with full CRUD
- ✅ Image upload support
- ✅ Contact form
- ✅ Blog/news section
- ✅ Product catalog
- ✅ Project showcase
- ✅ No database required (JSON-based storage)
