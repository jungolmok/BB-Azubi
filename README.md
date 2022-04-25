01. Locate this folder in Valet

02. Rename domain name in **package.json** & **.env.example**
    - package.json:
    ```
    'your-wpurl.test'
    ```
    - .env.example:
    ```
    WP_HOME='http://your-wpurl.test'
    ```

03. Set Datebase and rename the file:
  -  .env.example –> .env

04. .env:
  - Set database:
    ```
    DB_NAME=''
    DB_USER=''
    DB_PASSWORD=''
    ```
  - WP_ENV: (select the right environment of wordpress. It is important for SEO).
    ```
    WP_ENV='production' // if it is published.
    WP_ENV='development' // if something should be in progress.
    ```

05. Install npm
    ```
    npm i
    ```

06. composer install
    ```
    composer install
    ```

07. activ 11, 12 and 13 line in **.gitignore**:
    ```
    web/app/themes/jungolmok/assets/*
    !web/app/themes/jungolmok/assets/dist
    !web/app/themes/jungolmok/assets/images
    ```

08. 
  - Developmode:
    ```
    npm run dev
    ```
  - Productionmode:
    ```
    npm run prod
    ```


09. After it deployed, rename the file
    ```
    .htaccess.example -> .htaccess
    ```
***

https://bundb.de/

https://jungolmok.com/