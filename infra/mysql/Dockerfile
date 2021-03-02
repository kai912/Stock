FROM mysql@sha256:03306a1f248727ec979f61424c5fb5150e2c5fd2436f2561c5259b1258d6063c

ENV MYSQL_DATABASE=laravel_local \
  MYSQL_USER=phper \
  MYSQL_PASSWORD=secret \
  MYSQL_ROOT_PASSWORD=secret \
  TZ=Asia/Tokyo

COPY ./my.cnf /etc/mysql/conf.d/my.cnf
RUN chmod 644 /etc/mysql/conf.d/my.cnf
