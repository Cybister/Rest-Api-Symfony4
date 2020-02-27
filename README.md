# Rest-Api-Symfony4
Rest Api Symfony4 Implementation

##Usage example:

Create User:
```bash
bin/console fos:user:create
```
user: test_user
password: test

##1. Create Client using Api request:
http://<host>/createClient
Request:
```json
{"redirect-uri":"<host>","grant-type":"password"} 
(example: {"redirect-uri":"somedomain.com","grant-type":"password"}  )
```
Response will be something like this:
```json
{
"client_id": "1_5kxmltngysw8o888ggggwksksk4404kokokgow88scwoc0kw00",
"client_secret": "1u6pkny4hfb44gcso80o0g4kw84c0wocowso4o8kkgc44skosc"
}
```

##2. Get token request:
http://<host>/oauth/v2/token
And send:
```json
{
    "client_id": "1_5kxmltngysw8o888ggggwksksk4404kokokgow88scwoc0kw00",
    "client_secret": "1u6pkny4hfb44gcso80o0g4kw84c0wocowso4o8kkgc44skosc",
    "grant_type": "password",
    "username": "test_user",
    "password": "test"
}
```
Response:
```json
{
"access_token": "ZTFhMzlhNDRkNzg4ZjQ2MzQ5NzhhOTNkNGJjODYyNDgwZDdhMzUzMjYzMTMzOGY2ZTNkYzUzMTI2YmIyY2E1YQ",
"expires_in": 86400,
"token_type": "bearer",
"scope": null,
"refresh_token": "ODUxMTU5ZWIwOGY0ZjgyMjNiNTMxYzA4ZDQ5ZTVkZGQ0MTdhYTMzOTMzMjE5YTA0ODA5NmFlODYwZjIxYTAwZg"
}
```
##3. Now to access to the Rest Api we must send token in request headers
Authorization: Bearer ZTFhMzlhNDRkNzg4ZjQ2MzQ5NzhhOTNkNGJjODYyNDgwZDdhMzUzMjYzMTMzOGY2ZTNkYzUzMTI2YmIyY2E1YQ

To add task using POST method:
http://<host>/api/task
Body:
{
"name": "Some new task",
"description": "Some description"
}

To get all tasks using method GET:
http://<host>/api/tasks

To get one task using method GET:
http://<host>/api/task/<task_number> ( example: http://somedomain.com/api/task/2 )

To delete task using method DELETE:
http://<host>/api/task/<task_number> ( example: http://somedomain.com/api/task/2 )


