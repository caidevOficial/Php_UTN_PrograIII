<table align='center'>
  <tr>
    <td>
      <a href="https://github.com/caidevOficial/Php_UTN_PrograIII/" target="_blank"><img alt="Universidad Tecnológica Nacional" src="https://github.com/caidevOficial/Logos/raw/master/Instituciones/logo-utn_black_white.png?raw=true" height="100px" />
    </td>
    <td>
      <img align="center" alt="PhP" src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg?raw=true" height="200px" />
    </td>
  </tr>
</table>
</br>

---

![](https://hit.yhype.me/github/profile?user_id=12877139)

<p align="center">
    <img src="https://komarev.com/ghpvc/?username=caidevoficial&label=Profile%20views&color=0e75b6&style=plastic" alt="caidevoficial" />
</p>

<p align="left"> 
  <a href="https://github.com/CaidevOficial">
    <img src="https://github-profile-trophy.vercel.app/?username=caidevoficial&theme=nord&column=7" alt="caidevoficial" />
  </a> 
</p>

---

# PhP exercises from UTN. 👨‍💻
---

<details>
  <summary>:zap: GitHub Stats</summary>
    <img align="center" src="https://github-readme-stats-caidevposeidon.vercel.app/api?username=caidevOficial&show_icons=true&theme=chartreuse-dark&count_private=true&show_owner=true&include_all_commits=true" /><br><br>
</details>

<details>
    <summary>:zap: Most Used Languages</summary>
    <img align="center" src="https://github-readme-stats-caidevposeidon.vercel.app/api/top-langs/?username=caidevOficial&layout=compact&theme=chartreuse-dark&langs_count=10&exclude_repo=Java_Lineage2_aCis_From_345&hide=html,css"/><br>
</details>

Aplicación Slim Framework 4 PHP con despliegue automático en Heroku.
==============================

## Introducción
El principal objetivo de este repo es poder desplegar de forma automática nuestra aplicación PHP Slim Framework 4 en Heroku.

## 1- Forkear proyecto
Como primer paso, forkeamos este proyecto desde el boton ubicado en la parte superior derecha de la pagina del repositorio.

## 2- Subimos nuestro código (opcional si agregan código)
Una vez forkeado, clonamos el repo con `git clone <url del repo>` y agregamos nuestro codigo PHP (SLIM Framework) dentro de la carpeta `/app/`.
Luego comiteamos y pusheamos los cambios.

```sh
git add .
git commit -m "first commit"
git push -u origin main
```

## 3- Crear y configurar la App en Heroku

Nos dirigimos a la página de Heroku https://heroku.com/, iniciamos sesión si tenemos cuenta o creamos una.

Heroku al iniciar sesión nos muestra su dashboard, aquí haremos clic en **New** y luego en **Create new app**:

![Heroku1](https://i.ibb.co/MVTSH69/heroku1.png)

En esta sección agregamos el nombre de la app, seleccionamos la región United States y luego clic en botón **Create app**

![Heroku2](https://i.ibb.co/TwPJnrW/heroku2.png)

Ahora vamos a la sección **Deploy** y hacemos clic en la opción de GitHub, la cual nos mostrará nuestro usuario o tendremos que iniciar sesión con GitHub. Después   buscamos el nombre de nuestro repo y aparecerá abajo:

![Heroku3](https://i.ibb.co/vZjZgD6/heroku3.png)

Seleccionamos el repo y hacemos clic en **Connect**

Una vez hecho esto, elegimos la rama de github que queremos deplegar con nuestra aplicación Heroku, en nuestro caso `main`, y hacemos clic en **Enable Automatic Deploys**. De esta forma, cada vez que se haga una modificación a esta rama, Heroku va actualizar automáticamente la aplicación.

![Heroku4](https://i.ibb.co/d0z1NWv/heroku4.png)

Lo utlimo que deberiamos hacer es clic en el botón **Deploy Branch**. Esto solo se hace una sola vez, luego se hará de forma automática.

![Heroku5](https://i.ibb.co/sVYwVZx/heroku5.png)

Podemos verificar desde GitHub si el depliegue se hizo con exito. 

https://github.com/caidevOficial/Php_UTN_PrograIII_Heroku/deployments

![Heroku6](https://i.ibb.co/M87vVmd/Screenshot-at-Mar-29-19-44-49.png)

Desde el botón **View deployment** accedemos a la URL de la app desplegada.

https://slim-php-mysql-heroku.herokuapp.com/

## 4- Crear y configurar la base de datos MySQL (RemoteMysql)

Para esto vamos a crear una cuenta en RemoteMysql -> https://remotemysql.com/login.php que nos permite acceder gratuitamente a un servidor MySQL en la nube. 

En la parte de **Create Account** completamos los datos y creamos la cuenta:

![mysql1](https://i.ibb.co/rbZ7VXw/Screenshot-at-Mar-29-19-41-04.png)

Validamos la cuenta desde el link enviado al correo.

Iniciamos sesión, vamos a **DATABASES** y luego **CREATE NEW DATABASE**

![mysql2](https://i.ibb.co/NSmB9Qh/Screenshot-at-Mar-29-19-49-44.png)

Una vez creada, nos van a figurar los datos de conexion a la base de datos, es **MUY IMPORTANTE** copiar esa informacion porque solo aparecerá una vez.

![mysql3](https://i.ibb.co/YbcqDvK/Screenshot-at-Mar-29-19-50-39.png)

Copiamos estos datos y nos vamos al dashboard del proyecto en Heroku, en la pestaña **Settings**, la opción **Config Vars**.

Agregamos los siguientes datos Clave -> Valor:

```sh
MYSQL_HOST=remotemysql.com (campo "Server" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_PORT=3306 (campo "Port" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_USER=elcNx8VTCx (campo "Username" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_PASS=1234 (campo "Password" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_DB=elcNx8VTCx (campo "Database Name" de los datos que guardamos al crear la base en remotemysql.com)
```

![mysql3-1](https://i.ibb.co/8XQP54F/Screenshot-at-Mar-29-20-11-25.png)


## Acceder a phpMyAdmin, gestión la base de datos remota

Desde las opciones de la base creada, accedemos a **phpMyAdmin**

![mysql4](https://i.ibb.co/jvrdKFm/Screenshot-at-Mar-29-19-51-39.png)

Iniciamos sesion con los datos de la base

![mysql5](https://i.ibb.co/gF2nN9g/Screenshot-at-Mar-29-19-52-39.png)

Desde el panel de este sitio vamos a poder administrar las diferentes bases, crear y borrar tablas y hacer consultas SQL.

![mysql6](https://i.ibb.co/4sY1XNF/Screenshot-at-Mar-29-19-53-10.png)


## Requisitos para correr localmente

- Instalar PHP o XAMPP (https://www.php.net/downloads.php o https://www.apachefriends.org/es/download.html)
- Instalar Composer desde https://getcomposer.org/download/ o por medio de CLI:

```sh
php -r "copy('//getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
```

## Correr localmente via XAMPP

- Copiar proyecto dentro de la carpeta htdocs

```sh
C:\xampp\htdocs\
```
- Acceder por linea de comandos a la carpeta del proyecto y luego instalar Slim framework via Compose

```sh
cd C:\xampp\htdocs\<ruta-del-repo-clonado>
composer update
```
- En el archivo index.php agregar la siguiente linea debajo de `AppFactory::create();`

```sh
// Set base path
$app->setBasePath('/app');
```
- Abrir desde http://localhost/app ó http://localhost:8080/app (depende del puerto configurado en el panel del XAMPP)

## Correr localmente via PHP

- Acceder por linea de comandos a la carpeta del proyecto y luego instalar Slim framework via Compose

```sh
cd C:\<ruta-del-repo-clonado>
composer update
php -S localhost:666 -t app
```

- Abrir desde http://localhost:666/

## Archivo .env localmente

Crear dentro de la carpeta `/app/` el archivo `.env` tomando de referencia `.env.example`

Agregamos los siguientes datos Clave -> Valor:

```sh
MYSQL_HOST=remotemysql.com (campo "Server" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_PORT=3306 (campo "Port" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_USER=elcNx8VTCx (campo "Username" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_PASS=1234 (campo "Password" de los datos que guardamos al crear la base en remotemysql.com)
MYSQL_DB=elcNx8VTCx (campo "Database Name" de los datos que guardamos al crear la base en remotemysql.com)
```

---

<table align='center'>
  <theader align='center'>
    <th colspan="2" align='center'>
      <h2>Technologies used. 📌</h2>
    </th>
  </theader>
  <tbody align='center'>
    <tr>
      <td>
        <a href="https://www.apachefriends.org/es/index.html/">
          <img alt="PhP" src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg?raw=true" height="50px" />
        </a>
      </td>
      <td align="center">
        <h3>PhP</h3>
      </td>
    </tr>
    <tr>
      <td>
        <a href="https://www.mysql.com/">
          <img align="center" alt="MySQL" src="https://github.com/devicons/devicon/blob/master/icons/mysql/mysql-original-wordmark.svg?raw=true" height="50px" />
        </a>
      </td>
      <td>
        <h3>MySQL</h3>
      </td>
    </tr>
  </tbody>
</table>

---

## License 📄
This project is under license \[MIT License\] - read the file [LICENSE.md](LICENSE) for details.

---

## 

<table align='center'>
  <theader align='center'>
    <th align='center'>
      <h2>Where to find me: 🌎</h2>
    </th>
    <tr align='center'>
      <td>
        <img class="circular" alt="Facu" src="https://avatars1.githubusercontent.com/u/12877139?s=400&u=d369ee24466653d9bbeeb9654930e3ff1c67b76a&v=4" width="80px" height="80px" />
      </td>
    </tr>
    <th><center>🤴 Facu Falcone - Junior Developer</center></th>
  </theader>
  <tbody align='center'>
    <tr>
      <td>
        <a href="https://github.com/caidevOficial/">
          <img alt="GitHub" src="https://img.shields.io/badge/GitHub-%2312100E.svg?&style=for-the-badge&logo=Github&logoColor=white" width="125px" height="30px" />
        </a>
      </td>
    </tr>
    <tr>
      <td>
        <a href="https://www.linkedin.com/in/facundo-falcone/">
          <img alt="LinkedIn" src="https://img.shields.io/badge/linkedin-%230077B5.svg?&style=for-the-badge&logo=linkedin&logoColor=white" width="125px" height="30px" />
        </a>
      </td>
    </tr>
    <tr>
      <td>
        <a href="https://cafecito.app/caidevoficial/">
          <img alt='Invitame un café en cafecito.app' srcset='https://cdn.cafecito.app/imgs/buttons/button_5.png 1x, https://cdn.cafecito.app/imgs/buttons/button_5_2x.png 2x, https://cdn.cafecito.app/imgs/buttons/button_5_3.75x.png 3.75x' src='https://cdn.cafecito.app/imgs/buttons/button_5.png' width="125px" height="30px" />
        </a>
      </td>
    </tr>
    <tr>
      <td>
        <a href='https://ko-fi.com/P5P74JBOH' target='_blank'>
          <img width="125px" height="30px" style='border:0px;height:36px;' src='https://cdn.ko-fi.com/cdn/kofi1.png?v=2' border='0' alt='Buy Me a Coffee at ko-fi.com' />
        </a>
      </td>
    </tr>
  </tbody>
</table>
