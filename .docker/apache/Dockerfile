# Locked to debian buster, bullseye just released 08/21
# https://github.com/docker-library/php/tree/e81ce1cff2a8dc4a261c25a9164b8aefe498e218/7.4/buster/apache
FROM php:7.4-apache-buster

ARG BUILD_ARGUMENT_ENV=production
ARG BUILD_ARGUMENT_XDEBUG=false

ENV ENVIRONMENT ${BUILD_ARGUMENT_ENV}
ENV XDEUG_ENABLED ${BUILD_ARGUMENT_XDEBUG}

ARG UID=1000
ARG GID=1000
ENV USERNAME www-data
ENV APP_HOME /var/www/html

# Recommended by php docker to manage php extension dependencies
# https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    cron \
    nano \
    sudo \
    supervisor \
    unzip \
    vim \
&&  rm -rf /var/list/apt/* \
&&  rm -rf /var/lib/apt/lists/* \
&&  apt-get clean

# Install composer if $ENVIRONMENT is "local" for checking dependencies
RUN if [ "${ENVIRONMENT}" = "local" ]; then IPE_KEEP_SYSPKG_CACHE=1 install-php-extensions @composer; fi

# Install xdebug if ${ENVIRONMENT} is "local" and ${XDEUG_ENABLED} is "true"
COPY ./.docker/apache/local/xdebug.ini /tmp/
RUN if [ "${ENVIRONMENT}" = "local" ] && [ "${XDEUG_ENABLED}" = "true" ]; then \
    IPE_KEEP_SYSPKG_CACHE=1 install-php-extensions xdebug && \
    rm -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    mv /tmp/xdebug.ini /usr/local/etc/php/conf.d/; \
    else rm /tmp/xdebug.ini; \
    fi

# Use `docker run --rm php:7.40-apache-buster php -m` to see pre existing extensions
RUN install-php-extensions \
    bcmath \
    exif \
    gd \
    intl \
    mysqli \
    opcache \
    pdo_mysql \
    zip \
\
# Disable default site and delete default files inside APP_HOME
&&  a2dissite 000-default.conf \
&&  rm -r ${APP_HOME} \
\
# Create document root, chown
&&  mkdir -p ${APP_HOME}/public \
&&  mkdir -p /home/${USERNAME} \
&&  chown ${USERNAME}:${USERNAME} /home/${USERNAME} \
&&  usermod -u $UID ${USERNAME} -d /home/${USERNAME} \
&&  groupmod -g $GID ${USERNAME} \
&&  chown -R ${USERNAME}:${USERNAME} ${APP_HOME}

# php.ini production or dev
COPY ./.docker/apache/${ENVIRONMENT}/php.ini /usr/local/etc/php/php.ini

# Apache config
COPY ./.docker/apache/laravel.conf /etc/apache2/sites-available/laravel.conf
RUN a2ensite laravel.conf \
&&  a2enmod rewrite

# supervisord - httpd cron and queue worker (started via entrypoint.sh script)
COPY --chown=root:root ./.docker/apache/production/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY --chown=root:crontab ./.docker/apache/production/cron /var/spool/cron/crontabs/root
RUN mkdir -p /var/log/supervisor \
&&  chmod 0600 /var/spool/cron/crontabs/root

# Production Web and Worker scripts
COPY ./.docker/apache/production/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR ${APP_HOME}

COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
USER root

# Uncomment below to locally test respective entrypoint script
#ENTRYPOINT ["bash", "/entrypoint.sh"]
#ENTRYPOINT ["bash", "/worker.sh"]
