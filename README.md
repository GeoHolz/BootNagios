# BootNagios
BootNagios est un front end pour Nagios.

![alt text](https://raw.githubusercontent.com/geoholz/bootnagios/master/dist/img/ex.png)
![alt text](https://raw.githubusercontent.com/geoholz/bootnagios/master/dist/img/ex2.png)
![alt text](https://raw.githubusercontent.com/geoholz/bootnagios/master/dist/img/ex3.png)

Construit sur la base de AdminLTE ( BootStrap )

## Configuration
- Le fichier config.xml permet de configurer les différents chemin d'accés aux services (nconf, pnpn4nagios)
- Les noeux index dans permettent de rajouter des graphiques sur la page d'accueil. ( ou tout autre image)
```xml
<index>
		<name>Test</name>
		<url>http://X.X.X.X/pnp4nagios/image?host=FO&amp;srv=Trafic&amp;view=0&amp;source=0\</url>
</index>
```