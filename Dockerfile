FROM php:8.2-apache

# Install Python 3, pip, and curl
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    libcurl4-openssl-dev \
    && rm -rf /var/lib/apt-get/lists/*

# Install PHP cURL extension
RUN docker-php-ext-install curl

# Enable Apache Mod Rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Set Apache DocumentRoot to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Install Python requirements
RUN pip3 install --no-cache-dir -r backend_python/requirements.txt --break-system-packages

# Create startup script to run FastAPI on port 8000 and Apache on $PORT
RUN echo '#!/bin/sh\n\
python3 -m uvicorn backend_python.app:app --host 127.0.0.1 --port 8000 &\n\
sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf\n\
apache2-foreground' > /start.sh && chmod +x /start.sh

CMD ["/start.sh"]