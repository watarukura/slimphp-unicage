FROM amazonlinux:1

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH=$PATH:vendor/bin

RUN yum update -y \
    && yum upgrade -y \
    && yum install -y  \
      curl \
      git \
      libxml2 \
      libxml2-devel \
      jq \
      gcc \
      httpd24

RUN yum install -y \
      php72 \
      php72-pdo \
      php72-mbstring \
      php72-pecl-apcu \
      php72-opcache \
      php72-soap \
      php72-devel \
      php7-pear

RUN yum clean all

RUN sed -ie 's/$v_att_list = & func_get_args();/$v_att_list = func_get_args();/' /usr/share/pear7/Archive/Tar.php
RUN pear7 upgrade Archive_Tar
RUN pecl7 install xdebug

EXPOSE 80
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
