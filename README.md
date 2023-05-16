# Zoo Simulator
## Fasthosts Developer pre-Interview Test
___

### Introduction:

The application uses a React frontend and a PHP backend. TailwindCSS has been used for styling & Axios for making API calls.

The backend exposes a bunch of APIs which the static site consumes to get the data for the zoo.
These apis can also be consumed externally, as CORS has been enabled.
Session is being used to store the statea of the zoo until the page is refreshed, whereas the data is reset.

Docker has also been leveraged. The included docker-compose file spins up a `Apache` HTTPD server with `PHP 8.1.18` and `mod_rewrite` enabled to run the backend.
A `Node` server with `node 18.16.0` and `npm 9.5.1` is also included to run the frontend.

### Development Environments
* Mandatory:
  * `PHP 8.1`
* Optional:
  * `Node 18`
  * `Docker with Docker Compose`

### How to run the application:
* The simplest way to run the application is to `cd` into the `php` directory and run `php -S localhost::8110`. After that, open `http://localhost:8110` in your browser. This requires `PHP 8.1` to be installed on the machine.


* If you have `Node` installed, you can follow the previous step by running `npm install` from inside the `react` directory of the project to install the dependencies. After that, run `npm start` to start the application. This will spin up a `Node` server on port `8120`. After that, open `http://localhost:8120` in your browser.


* Alternatively, you can run the application using `Docker`. To do that, run `docker-compose up` from the root directory of the project. This will spin up a `Node` server on port `8120` and a `PHP` server on port `8110`. After that, open `http://localhost:8120` in your browser.