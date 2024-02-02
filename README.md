# Despliegue automático de entorno de desarrollo con Vagrant y Docker
###### Todas las contraseñas y usuarios son user: vagrant/root pass: vagrant excepto en el servidor Samba (user: developers, pass: developers).

###### En las máquinas cliente los usuarios disponibles son (user=dev1, pass=dev1) y (user=dev2,pass=dev2).
# ¿Qué servicios despliega?

- Servidor DHCP
- Servidor DNS
- Servidor Samba
- Servidor Web (Nginx)

El servidor DNS apunta los dominios:

- dev1.abel.org &rarr; Directorio dev1 de servidor Web.
- dev2.abel.org &rarr; Directorio dev2 de servidor Web.
- samba.abel.org &rarr; Servidor samba.
- samba.abel.org &rarr; Servidor samba.
- ns.abel.org &rarr; Servidor dns.
- dhcp.abel.org &rarr; Servidor dhcp.
###### Las resoluciones del servidor DNS son solo de ejemplo puesto que todas apuntan a la misma ip, en un caso real apuntarían a direcciones ip independientes.


# Modo de uso

Clonar el repositorio.

``abelsrz@dev~$  git clone https://github.com/abelsrzz/devOps-enviroment-deployment-with-Vagrant``


Levantar el servidor.

``abelsrz@dev~$ vagrant up``


Levantar el cliente (dev1 o dev2)

``abelsrz@dev~$  vagrant up dev{1, 2}``

Para arrancar el entorno gráfico del cliente debemos ejecutar el comando `$ startx` en cualquiera de las máquinas cliente (Solo en el primer arranque de la máquina).

