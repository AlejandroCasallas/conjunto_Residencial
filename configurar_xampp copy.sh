#!/bin/bash

# Define tu IP local (cambia esto si es necesario)
IP_LOCAL="192.168.0.100"

# 1. Cambiar configuración de Apache para escuchar en todas las interfaces
echo "Configurando Apache para escuchar en todas las interfaces..."
sudo sed -i 's/^Listen 127.0.0.1:80/Listen 0.0.0.0:80/' /opt/lampp/etc/httpd.conf

# 2. Cambiar ServerName a la IP local
echo "Cambiando ServerName a la IP local ($IP_LOCAL)..."
sudo sed -i "s/^ServerName localhost/ServerName $IP_LOCAL/" /opt/lampp/etc/httpd.conf

# 3. Permitir acceso a phpMyAdmin desde la red local
echo "Permitendo acceso a phpMyAdmin desde la red local..."
sudo sed -i 's/Require local/Require all granted/' /opt/lampp/etc/extra/httpd-xampp.conf

# 4. Reiniciar Apache para aplicar cambios
echo "Reiniciando Apache..."
sudo /opt/lampp/lampp restart

# 5. (Opcional) Desactivar firewall (temporalmente)
echo "Desactivando el firewall (temporalmente)..."
sudo systemctl stop firewalld

# 6. (Opcional) Abrir puerto 80 en el firewall para acceso futuro
echo "Abriendo puerto 80 en el firewall..."
sudo firewall-cmd --zone=public --add-port=80/tcp --permanent
sudo firewall-cmd --reload

echo "Configuración completada. XAMPP debería ser accesible desde la red local en http://$IP_LOCAL"
