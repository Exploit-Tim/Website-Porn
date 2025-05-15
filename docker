FROM php:8.2-cli

# Install extensions kalau perlu (misal curl, gd, dll)
RUN apt-get update && apt-get install -y unzip curl

# Copy semua file ke container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Jalankan server PHP built-in di port 10000
CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
