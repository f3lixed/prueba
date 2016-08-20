Dusoft
======
Dusoft inicia con la ejecución de proyectos administrativos como lo son glosas y contratación, este se comunica directamente con asistencial(SIIS) mediante la base de datos y con FI mediante el uso de servicios web SOAP. La aplicación se fracciona en dos componentes, una API web basada en servicios restful escrita en Symfony PHP y una rich interface escrita en angularjs.

Instalación
-----------
para realizar la instalación de la aplicación se necesita [git](https://git-scm.com/), [nodejs](https://nodejs.org/) y [composer](https://getcomposer.org/). Node instalara automatica npm con el cual se debe ejecutar:

```batch
npm install -g grunt-cli
```
```batch
npm install -g bower
```

El proyecto se debe instalar mediante [git](https://git-scm.com/book/es/v1/Empezando-Configurando-Git-por-primera-vez), se debe dirigir hasta la carpeta donde quedara ubicado el proyecto (ejem. ```cd c:xampp/htdocs```) y proceder a realizar la copia.

```batch
git clone http://nombre.usuario@10.0.0.60/asistencial/dusoft.git
```
Al haber instalado tanto el proyecto como bower y grunt se deben instalar las dependencias propias del proyecto, para esto se debe navegar por consola hasta la ubicación del proyecto (ejem. ```cd c:xampp/htdocs/dusoft```) y ejecutar el comando:

```batch
composer install
```
luego en la carpeta **web** del proyecto:

```batch
npm install
```
```batch
bower install
```

para finalizar se debe ejecutar ```grunt``` con esto se realizan los procesos de unificación y minificación de archivos javascript y css.

Cada vez que se trabaje con archivos javascript o css se debe tener activo grunt.

A tener en cuenta
-----------------
no borrar NINGUN archivo ```.keepignore```

La compresión de archivos tanto javascript como css se realiza con los archivos *compress.json* y *compress.styl* respectivamente, en estos archivos se establece el orden en el cual se van a ir comprimiendo los archivos.
