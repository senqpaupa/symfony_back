FROM nginx:alpine

# Удаляем дефолтную конфигурацию nginx
RUN rm /etc/nginx/conf.d/default.conf

# Копируем нашу конфигурацию
COPY conf/default.conf /etc/nginx/conf.d/

# Создаем директорию для логов
RUN mkdir -p /var/log/nginx

# Устанавливаем корректные права
RUN chown -R nginx:nginx /var/log/nginx

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"] 