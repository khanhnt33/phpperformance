FROM php:5-fpm

ENV TZ=Asia/Ho_Chi_Minh

# Install dependencies
RUN apt-get update && apt-get install -y \
    git gcc make \
    libpcre3-dev \
    libmcrypt-dev \
    zlib1g-dev \
--no-install-recommends && rm -r /var/lib/apt/lists/*

# Config PHP extension: Possibale values
# bcmath bz2 calendar ctype curl dba dom enchant exif fileinfo filter ftp gd gettext gmp hash iconv imap interbase intl json ldap mbstring mcrypt mssql mysql mysqli oci8 odbc opcache pcntl pdo pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pdo_sqlite pgsql phar posix pspell readline recode reflection session shmop simplexml snmp soap sockets spl standard sybase_ct sysvmsg sysvsem sysvshm tidy tokenizer wddx xml xmlreader xmlrpc xmlwriter xsl zip

# Install php extensions
#RUN docker-php-ext-configure \
#    zip
 
RUN docker-php-ext-install \
        mbstring \
        pdo \
        pdo_mysql \
        mcrypt \
        zip

# Config phalcon extension
RUN echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini

# Install compose
RUN curl https://getcomposer.org/download/1.0.0-alpha11/composer.phar > /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Compile phalcon
RUN git clone --depth=1 git://github.com/phalcon/cphalcon.git \
    && cd cphalcon/build \
    && ./install

# Install Phalcon Developer Tools via COMPOSER
RUN cd /usr/src/ \
  && git clone https://github.com/phalcon/phalcon-devtools.git

RUN ln -s  /usr/src/phalcon-devtools/phalcon.php /usr/bin/phalcon \
  && chmod +x /usr/bin/phalcon

# Install Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
# Install benchmark
RUN pear install Benchmark-1.2.9

# Remove garbage
RUN apt-get purge -y --auto-remove git gcc make \
    && apt-get clean all \
    && rm -r /var/lib/apt/lists/*

# Copy custome php.ini
COPY ./conf/php.ini /usr/src/php/
COPY ./conf/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

VOLUME /usr/local/bin/
VOLUME /usr/src/phalcon-devtools 
WORKDIR /var/www/html

CMD ["php-fpm"]