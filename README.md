Stack:
PHP 8.3 installed (any 8.x version might work)
Composer installed
NPM 10.x installed
Node 20.x installed

Instructions:

1. Pull app code:
   git pull git@github.com:AnsisKengis/powerbi-screenshot-capturer.git

2. Run:
   composer install

3. Run:
   npm install puppeteer

4. Run this command to create screenshots:
   php artisan screenshots:capture

5. Create cron scheduler to run this every 5 minutes:
   _/5 _ \* \* \* cd /path/to/your/project && php artisan screenshots:capture >> /dev/null 2>&1
