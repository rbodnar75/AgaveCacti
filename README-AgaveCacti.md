# AgaveCacti - Modern Theme for Cacti Network Monitoring

AgaveCacti is a completely modernized theme for Cacti featuring the sleek "Agave" design with enhanced navigation, accessibility, and user experience. This project transforms the traditional Cacti interface into a contemporary, mobile-first monitoring platform.

## 🌵 What's New in AgaveCacti

### Modern Agave Theme
- **High-Contrast Design**: Improved color contrast ratios for better readability and accessibility
- **Responsive Layout**: Fully mobile-friendly interface that adapts to all screen sizes
- **Modern CSS Variables**: Dynamic theming system with CSS custom properties
- **Professional Styling**: Clean, contemporary interface with modern design principles
- **Enhanced Typography**: Improved font hierarchy and readability

### Comprehensive Navigation System
- **Realm-Based Permissions**: Intelligent navigation that shows only accessible sections
- **Organized Sections**: 8 major functional areas (Dashboard, Graphs, Management, Templates, Data Collection, Automation, Import/Export, Administration, Reports)
- **Mobile-First Design**: Collapsible sidebar with smooth hamburger menu animations
- **Contextual Navigation**: Dynamic menu based on user permissions and roles
- **Keyboard Accessible**: Full keyboard navigation support with ARIA labels

### Enhanced Graph Visibility
- **Forced Graph Display**: JavaScript ensures all graphs are visible and properly rendered
- **Responsive Graph Containers**: Graphs scale appropriately on all devices
- **Enhanced Loading**: Improved graph loading performance and error handling
- **Mobile Optimization**: Touch-friendly graph interactions

### Accessibility Improvements
- **WCAG Compliance**: High contrast colors meeting accessibility standards
- **Screen Reader Support**: Proper ARIA labels and semantic HTML structure
- **Keyboard Navigation**: Full keyboard accessibility with focus indicators
- **Enhanced Form Controls**: Improved focus states and input accessibility
- **Color Contrast**: Text/background combinations optimized for readability

### Technical Enhancements
- **Modern JavaScript**: ES6+ features with mobile menu handling and graph enhancement
- **CSS Grid & Flexbox**: Contemporary layout system with responsive design
- **Performance Optimized**: Lightweight JavaScript with efficient event handling
- **Error Handling**: Robust error handling and graceful degradation

## 🚀 Installation & Setup

### Quick Start
1. **Download/Clone**: Get AgaveCacti from the GitHub repository
2. **Deploy Files**: Copy to your web server directory (e.g., `/var/www/html/AgaveCacti/`)
3. **Configure URL Path**: Update `include/config.php` with correct `$url_path`
4. **Set Permissions**: Ensure proper file permissions for web server
5. **Access Interface**: Navigate to your AgaveCacti URL

### Detailed Installation
```bash
# Clone the repository
git clone https://github.com/rbodnar75/AgaveCacti.git
cd AgaveCacti

# Copy to web server directory
sudo cp -r . /var/www/html/AgaveCacti/

# Set proper permissions
sudo chown -R www-data:www-data /var/www/html/AgaveCacti/
sudo chmod -R 755 /var/www/html/AgaveCacti/
```

### Configuration Updates Required
1. **config.php**: Ensure `$url_path = '/AgaveCacti/';` (or your path)
2. **Database**: Use existing Cacti database or configure new connection
3. **Web Server**: Configure Apache/Nginx virtual host if needed

## 🎨 Agave Theme Architecture

### File Structure
```
include/themes/agave/
├── main.css           # Complete theme stylesheet with CSS variables
├── agave.js          # Modern JavaScript for navigation and enhancements  
├── top_header.php    # Header with comprehensive navigation system
└── bottom_footer.php # Clean footer with proper content closure
```

### Design System Features
- **CSS Custom Properties**: Dynamic theming with `:root` variables
- **High-Contrast Colors**: Accessibility-focused color palette
  - Primary: `#1e40af` (improved contrast)
  - Text: `#0f172a` (high contrast dark)
  - Backgrounds: `#f8fafc` (light) / `#1e293b` (dark)
- **Responsive Typography**: Fluid font scaling across devices
- **Modern Spacing**: Consistent spacing scale using CSS variables

### Navigation System
- **Realm Integration**: Automatically shows/hides sections based on Cacti permissions
- **8 Main Sections**: Dashboard, Graphs, Management, Templates, Data Collection, Automation, Import/Export, Administration, Reports
- **20+ Permission Checks**: Full integration with Cacti's realm system
- **Mobile Menu**: Touch-friendly overlay navigation for small screens

### JavaScript Features
- **Mobile Navigation**: Hamburger menu with smooth animations
- **Graph Enhancement**: Automatic graph visibility enforcement
- **Accessibility**: Keyboard navigation and ARIA label management
- **Performance**: Debounced events and efficient DOM manipulation

## 📱 Mobile & Responsive Experience

### Mobile Navigation
- **Hamburger Menu**: Three-line menu button that toggles sidebar
- **Touch Gestures**: Swipe and tap interactions optimized for mobile
- **Overlay System**: Full-screen overlay for mobile menu with backdrop
- **Escape Key**: Close menu with escape key for accessibility

### Responsive Features
- **Breakpoint System**: Optimized for desktop (1024px+), tablet, and mobile
- **Flexible Layout**: CSS Grid and Flexbox for fluid layouts
- **Responsive Graphs**: Charts and graphs scale appropriately on all screens
- **Mobile Tables**: Horizontal scroll for data-heavy tables
- **Touch-Friendly Buttons**: Minimum 44px touch targets

## 🛠️ Technical Implementation

### Fixed Issues Resolved
1. **URL Redirection**: Fixed `config.php` path from `/cacti/` to `/AgaveCacti/`
2. **Theme Consistency**: Comprehensive theme application across all pages
3. **Graph Visibility**: JavaScript enforcement ensures all graphs display properly
4. **Color Contrast**: High-contrast color system for improved readability
5. **Navigation Coverage**: Complete realm-based navigation system

### CSS Architecture
- **CSS Variables**: Modern theming with `:root` custom properties
- **Mobile-First**: Responsive design starting from 320px width
- **High Performance**: Optimized CSS with minimal unused styles
- **Accessibility**: Focus indicators, high contrast, and semantic styling

### JavaScript Architecture
- **ES6+ Classes**: Modern JavaScript with proper class structure
- **Event Delegation**: Efficient event handling with minimal memory footprint
- **Mutation Observer**: Dynamic content monitoring for graph enhancement
- **Accessibility APIs**: ARIA label management and keyboard navigation

### PHP Integration
- **Realm Permissions**: Full integration with `is_realm_allowed()` functions
- **Theme Compatibility**: Maintains compatibility with Cacti's theme system
- **Plugin Support**: Preserves all plugin hook functionality
- **Internationalization**: Supports Cacti's `__()` translation functions

## 🎯 Browser Support

AgaveCacti supports all modern browsers:
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+

## 📊 Features Preserved

All original Cacti functionality is preserved:
- Device monitoring
- Graph generation
- Data collection
- User management
- Plugin system
- Templates
- Automation

## 🔧 Customization & Configuration

### Theme Customization
Edit `/include/themes/agave/main.css` to customize:
```css
:root {
  /* Primary Colors */
  --primary-color: #1e40af;
  --primary-hover: #1d4ed8;
  
  /* Text Colors */
  --text-primary: #0f172a;
  --text-secondary: #334155;
  
  /* Background Colors */
  --background-primary: #f8fafc;
  --background-secondary: #e2e8f0;
}
```

### Navigation Customization
Modify `/include/themes/agave/top_header.php` to:
- Add new navigation sections
- Customize realm permission checks
- Update navigation icons and labels
- Modify mobile menu behavior

### JavaScript Customization
Extend `/include/themes/agave/agave.js` to:
- Add custom interactions
- Modify mobile menu behavior
- Implement additional accessibility features
- Customize graph enhancement logic

## � Troubleshooting

### Common Issues & Solutions

#### Graphs Not Displaying
- **Check JavaScript**: Verify `agave.js` is loading without errors
- **Permissions**: Ensure user has proper graph viewing permissions (realm 7)
- **Browser Console**: Check for JavaScript errors in developer tools
- **Clear Cache**: Browser cache might contain old graph references

#### Navigation Items Missing
- **Realm Permissions**: Verify user has appropriate realm access in Cacti
- **Permission Debug**: Check `is_realm_allowed()` function returns
- **User Groups**: Ensure user is in correct groups with proper permissions

#### Mobile Menu Not Working
- **JavaScript Loading**: Confirm `agave.js` loads properly
- **Touch Events**: Verify browser supports touch events
- **CSS Media Queries**: Check responsive CSS is applying correctly

#### URL Redirection Issues
- **config.php**: Verify `$url_path` matches your installation directory
- **Web Server**: Check Apache/Nginx configuration for proper document root
- **File Permissions**: Ensure web server can read AgaveCacti files

#### Color Contrast Problems
- **CSS Variables**: Check if browser supports CSS custom properties
- **Override Styles**: Look for conflicting CSS from plugins or customizations
- **Browser Compatibility**: Verify browser supports modern CSS features

### Debug Mode
Enable debug logging by adding to `config.php`:
```php
$config['log_verbosity'] = POLLER_VERBOSITY_HIGH;
```

## 🔒 Security

All original Cacti security features are maintained:
- User authentication
- Role-based access
- CSRF protection
- Input validation

## 🤝 Contributing

### Development Setup
1. **Fork Repository**: Fork the AgaveCacti repository on GitHub
2. **Local Development**: Set up local web server with PHP and MySQL
3. **Theme Development**: Work in `/include/themes/agave/` directory
4. **Testing**: Test across different browsers and devices

### Code Standards
- **PHP**: Follow Cacti coding standards and PSR-12
- **CSS**: Use CSS custom properties and mobile-first responsive design
- **JavaScript**: ES6+ with proper error handling and accessibility
- **Documentation**: Update README for any new features or changes

### Pull Request Process
1. Create feature branch from main
2. Make changes with proper commit messages
3. Test thoroughly across browsers and devices
4. Update documentation if needed
5. Submit pull request with clear description

### Areas for Contribution
- **Accessibility**: Further WCAG compliance improvements
- **Performance**: CSS/JavaScript optimization
- **Mobile**: Enhanced mobile user experience
- **Internationalization**: Translation support
- **Browser Compatibility**: Support for older browsers

## 📋 Requirements & Compatibility

### System Requirements
- **PHP**: 7.4+ (8.0+ recommended)
- **Database**: MySQL 5.7+ or MariaDB 10.2+
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **RRDtool**: Latest stable version for graph generation
- **Memory**: 512MB+ RAM recommended

### Browser Support
- **Chrome**: 90+ (full support)
- **Firefox**: 88+ (full support)
- **Safari**: 14+ (full support)
- **Edge**: 90+ (full support)
- **Mobile**: iOS Safari 14+, Chrome Mobile 90+

### Cacti Compatibility
- **Version**: Based on Cacti 1.2.x branch
- **Plugins**: Full compatibility with existing Cacti plugins
- **Database**: Uses existing Cacti database structure
- **APIs**: Maintains all Cacti API compatibility
- **Configuration**: Preserves existing Cacti settings and configurations

### Migration from Standard Cacti
1. **Backup**: Always backup your existing Cacti installation
2. **Database**: AgaveCacti uses the same database structure
3. **Plugins**: All existing plugins should continue working
4. **Themes**: Users can switch between Agave and classic themes
5. **Data**: All historical data and configurations are preserved

## 🎨 Theme Selection & Configuration

### Automatic Agave Theme
AgaveCacti is designed with the Agave theme as the primary interface. The theme is automatically loaded through:
- `top_header.php`: Loads `main.css` and `agave.js`
- CSS class: `<html class='agave-theme'>` for theme-specific styling
- Responsive meta tags for proper mobile display

### Manual Theme Configuration (if needed)
If you need to configure themes manually:
1. **Admin Settings**: Go to Configuration → Settings → General
2. **User Settings**: Users can override in their profile settings
3. **Default Theme**: Set "agave" as the default theme for new users

### Theme Integration
The Agave theme integrates seamlessly with:
- **Cacti Core**: All standard Cacti functionality
- **Plugin System**: Maintains compatibility with plugins
- **Custom Code**: Existing customizations should continue working
- **API Calls**: All API functionality preserved

## 📊 Performance & Optimization

### CSS Performance
- **CSS Variables**: Efficient dynamic theming
- **Minimal CSS**: Only necessary styles loaded
- **Mobile-First**: Optimized for mobile performance
- **Critical Path**: Important styles loaded first

### JavaScript Performance
- **Lazy Loading**: Features load as needed
- **Event Delegation**: Efficient event handling
- **Debouncing**: Smooth interactions without performance hits
- **Memory Management**: Proper cleanup and optimization

### Graph Performance
- **Enhanced Loading**: JavaScript ensures proper graph display
- **Error Handling**: Graceful fallbacks for failed graph loads
- **Responsive Images**: Appropriate sizing for different devices
- **Caching**: Leverages browser caching for better performance

## � License & Acknowledgments

### License
AgaveCacti maintains the same GPL v2+ license as the original Cacti project, ensuring:
- **Open Source**: Free to use, modify, and distribute
- **Community Driven**: Contributions welcome from the community
- **Compatibility**: Maintains licensing compatibility with Cacti ecosystem

### Acknowledgments
- **Cacti Team**: Original Cacti development team for the robust monitoring platform
- **Cacti Community**: Users and contributors who make Cacti great
- **Accessibility Standards**: WCAG guidelines for inclusive design
- **Modern Web Standards**: W3C specifications for responsive and accessible web design

### Repository Information
- **GitHub**: https://github.com/rbodnar75/AgaveCacti
- **Version**: 1.0.0 (based on Cacti 1.2.x)
- **Author**: Rick Bodnar (rbodnar75)
- **Created**: 2025

---

**AgaveCacti** - Where modern design meets powerful network monitoring! 🌵📊

*Transform your Cacti monitoring experience with the sleek, accessible, and mobile-friendly Agave theme.*
