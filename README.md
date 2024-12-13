<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a id="readme-top"></a>

[![Contributors][contributors-shield]][contributors-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/OLLC137/nutlabs-ojt-portal">
    <img src="public/images/portal-logo.png" alt="Logo" width="350">
  </a>
</div>

<!-- ABOUT THE PROJECT -->
## About The Project

The OJT portal is a portal site for all things regarding student internships for BSU students. It aims to streamline the OJT process by packaging everything that students, OJT heads, and OJT coordinators need during an OJT semester.

The OJT Portal is a web-based application designed to streamline and enhance the management of OJT processes at Batangas State University.

Key functionalities include the ability for students to apply for internships, upload and track requirements, and post journals, while faculty and coordinators can monitor progress and manage student submissions. The portal also allows companies to post internships and review applications.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

* [![Laravel][Laravel.com]][Laravel-url]
* [![Livewire][Livewire.com]][Livewire-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![PostgreSQL][PostgreSQL.com]][PostgreSQL-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

### Prerequisites
- **postgreSQL 16**
- **NodeJS 20.x**
- **PHP 8.2+**
- **Composer**

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/OLLC137/nutlabs-ojt-portal.git
   ```
2. Install NPM packages
   ```sh
   npm install
   ```
3. Install php artisan packages
   ```sh
   composer install
   ```
4. Copy .env.example to .env and change variables
   ```sh
   cp .env.example .env
   ```
    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
5. Run artisan commands
   ```sh
   php artisan refresh:db
   ```
   ```sh
   php artisan storage:link
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- USAGE EXAMPLES -->
## Usage
To run the system locally, execute the following commands on two separate terminals
```sh
php artisan serve
```
```sh
npm run dev
```


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/OLLC137/nutlabs-ojt-portal.svg?style=for-the-badge
[contributors-url]: https://github.com/OLLC137/nutlabs-ojt-portal/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/OLLC137/nutlabs-ojt-portal.svg?style=for-the-badge
[forks-url]: https://github.com/OLLC137/nutlabs-ojt-portal/network/members
[stars-shield]: https://img.shields.io/github/stars/OLLC137/nutlabs-ojt-portal.svg?style=for-the-badge
[stars-url]: https://github.com/OLLC137/nutlabs-ojt-portal/stargazers
[issues-shield]: https://img.shields.io/github/issues/OLLC137/nutlabs-ojt-portal.svg?style=for-the-badge
[issues-url]: https://github.com/OLLC137/nutlabs-ojt-portal/issues
[license-shield]: https://img.shields.io/github/license/OLLC137/nutlabs-ojt-portal.svg?style=for-the-badge
[license-url]: https://github.com/OLLC137/nutlabs-ojt-portal/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/linkedin_username
[product-screenshot]: images/screenshot.png
[Next.js]: https://img.shields.io/badge/next.js-000000?style=for-the-badge&logo=nextdotjs&logoColor=white
[Next-url]: https://nextjs.org/
[React.js]: https://img.shields.io/badge/React-20232A?style=for-the-badge&logo=react&logoColor=61DAFB
[React-url]: https://reactjs.org/
[Vue.js]: https://img.shields.io/badge/Vue.js-35495E?style=for-the-badge&logo=vuedotjs&logoColor=4FC08D
[Vue-url]: https://vuejs.org/
[Angular.io]: https://img.shields.io/badge/Angular-DD0031?style=for-the-badge&logo=angular&logoColor=white
[Angular-url]: https://angular.io/
[Svelte.dev]: https://img.shields.io/badge/Svelte-4A4A55?style=for-the-badge&logo=svelte&logoColor=FF3E00
[Svelte-url]: https://svelte.dev/
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com
[Livewire.com]: https://img.shields.io/badge/Livewire-4D77A3?style=for-the-badge&logo=livewire&logoColor=white
[Livewire-url]: https://laravel-livewire.com
[PostgreSQL.com]: https://img.shields.io/badge/PostgreSQL-336791?style=for-the-badge&logo=postgresql&logoColor=white
[PostgreSQL-url]: https://www.postgresql.org
