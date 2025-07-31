#!/bin/bash

echo "🌵 AgaveCacti Setup Script"
echo "=========================="
echo ""

# Check if we're in the right directory
if [ ! -f "index.php" ] || [ ! -d "include/themes/agave" ]; then
    echo "❌ Error: Please run this script from the AgaveCacti root directory"
    exit 1
fi

echo "✅ AgaveCacti files detected"

# Set proper permissions
echo "📁 Setting file permissions..."
find . -type f -name "*.php" -exec chmod 644 {} \;
find . -type f -name "*.css" -exec chmod 644 {} \;
find . -type f -name "*.js" -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Make sure cache and log directories are writable
chmod -R 775 cache/ 2>/dev/null || echo "⚠️  Cache directory not found - will be created by Cacti"
chmod -R 775 log/ 2>/dev/null || echo "⚠️  Log directory not found - will be created by Cacti"
chmod -R 775 rra/ 2>/dev/null || echo "⚠️  RRA directory not found - will be created by Cacti"

echo "✅ File permissions set"

# Check PHP requirements
echo "🔍 Checking PHP requirements..."
php_version=$(php -v | head -n 1 | grep -oP '\d+\.\d+')

if [ "$(printf '%s\n' "7.4" "$php_version" | sort -V | head -n1)" = "7.4" ]; then
    echo "✅ PHP $php_version is supported"
else
    echo "❌ PHP $php_version is not supported. AgaveCacti requires PHP 7.4 or higher"
    exit 1
fi

# Check for required PHP extensions
required_extensions=("mysql" "snmp" "xml" "session" "sockets" "ldap" "gd" "zip")
missing_extensions=()

for ext in "${required_extensions[@]}"; do
    if ! php -m | grep -qi "$ext"; then
        missing_extensions+=("$ext")
    fi
done

if [ ${#missing_extensions[@]} -ne 0 ]; then
    echo "❌ Missing PHP extensions: ${missing_extensions[*]}"
    echo "   Please install these extensions before continuing"
    exit 1
else
    echo "✅ All required PHP extensions are available"
fi

echo ""
echo "🎨 AgaveCacti Modern Theme Features:"
echo "   • Responsive mobile-friendly design"
echo "   • Modern dashboard with real-time metrics"
echo "   • Dark mode support"
echo "   • Enhanced navigation and user experience"
echo "   • Card-based layout with smooth animations"
echo ""

echo "📋 Next Steps:"
echo "1. Configure your database connection in include/config.php"
echo "2. Set up your web server to point to this directory"
echo "3. Run the Cacti installer: http://your-server/install/"
echo "4. After installation, go to Settings → Theme and select 'Agave'"
echo ""

echo "🌐 Web Server Configuration Examples:"
echo ""
echo "Apache Virtual Host:"
echo "<VirtualHost *:80>"
echo "    DocumentRoot $(pwd)"
echo "    ServerName your-cacti-server.com"
echo "    <Directory $(pwd)>"
echo "        AllowOverride All"
echo "        Require all granted"
echo "    </Directory>"
echo "</VirtualHost>"
echo ""

echo "Nginx Configuration:"
echo "server {"
echo "    listen 80;"
echo "    server_name your-cacti-server.com;"
echo "    root $(pwd);"
echo "    index index.php index.html;"
echo ""
echo "    location / {"
echo "        try_files \$uri \$uri/ /index.php?\$args;"
echo "    }"
echo ""
echo "    location ~ \.php$ {"
echo "        fastcgi_pass unix:/var/run/php/php-fpm.sock;"
echo "        fastcgi_index index.php;"
echo "        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;"
echo "        include fastcgi_params;"
echo "    }"
echo "}"
echo ""

echo "🔒 Security Recommendations:"
echo "• Use HTTPS in production"
echo "• Set up proper firewall rules"
echo "• Use strong database passwords"
echo "• Keep AgaveCacti updated"
echo ""

echo "✅ AgaveCacti setup complete!"
echo "   Visit the README-AgaveCacti.md file for detailed documentation"
