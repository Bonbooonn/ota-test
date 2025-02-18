# OTA Programming test

Requisites
- Git
- Docker
- Postman
- Npm
- Install Make in your wsl2 machine for windows, for macOS just install it directly.
  - MacOS: brew install make
  - Windows WSL2: apt-get -y install make

To run the application.
- Clone the repository **(git clone https://github.com/Bonbooonn/ota-test.git)**
- Go to **cd ota-test**
- Go to **cd dev**
- Run **cp .env.example .env**
- Run **make create-network**
- Go to **cd ../fe**
- Run **npm install** you should have npm installed in your machine this is important to not have `vite` errors
- Go to **cd ../dev**
- Run **make start-selected**
- Go to **cd ../be-api**
- Run **cp .env.example .env**
- Update env file to
```
DB_CONNECTION=mysql
DB_HOST=local-app-database
DB_PORT=3306
DB_DATABASE=otadb
DB_USERNAME=root
DB_PASSWORD=project
```
- Change `MAILER` environment variables to receive email
- Go to your DBMS and add this databases `otadb` and `otadb-test`
- Run **make composer-install**
- Run **make generate-key**
- Run **make run-fresh-migrations** to create the tables fresh
- Update hosts file
    - For mac **cd /etc/hosts**
    - For windows
        - Open notepad and run as administrator
        - Open C:\Windows\System32\drivers\etc\hosts
    - Add the following
        ```
        127.0.0.1 ota-test.local
        127.0.0.1 api.ota-test.local
        ```
- To stop **make stop-selected**

To Add the pre-requisite datas
- Go to **cd ../be-api** if you're not on the `be-api` directory
- Run **make create-user**
    - Answer the prompt to create the user
- To create a job board
    - Open postman
    - Login to `POST` `http://api.ota-test.local/api/v1/user/authenticate` using the credentials created in the command
    - Make a request `POST` to `http://api.ota-test.local/api/v1/job-board/create`
    - Add Authorization
        - Bearer Token and the value of the token when you signed in.
    - In the body
    ```
    {
        "title": "Job board 1",
        "description": "Hey hey"
    }
    ```
- Once all is done, visit `http://ota-test.local`
