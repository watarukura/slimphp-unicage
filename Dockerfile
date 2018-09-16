FROM amazonlinux:latest

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH=$PATH:vendor/bin

RUN amazon-linux-extras install -y \
    php7.2

RUN yum update -y \
    && yum upgrade -y \
    && yum install -y  \
      curl \
      git \
      libxml2 \
      libxml2-devel \
      jq \
      gcc \
      make \
      httpd24

RUN yum install -y \
      php \
      php-pdo \
      php-mbstring \
      php-devel \
      php-opecache \
      php-pear

RUN yum clean all

RUN pecl install xdebug

EXPOSE 80
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
