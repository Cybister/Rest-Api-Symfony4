# Rest-Api-Symfony4
Rest Api Symfony4 Implementation

## Usage example:

Create User:
```bash
bin/console fos:user:create
```
user: test_user
password: test

1. Create Client using Api request:
http://<host>/createClient
Request:
```json
{"redirect-uri":"<host>","grant-type":"password"} 
```
(example: {"redirect-uri":"somedomain.com","grant-type":"password"}  )

Response will be something like this:
```json
{
"client_id": "1_5kxmltngysw8o888ggggwksksk4404kokokgow88scwoc0kw00",
"client_secret": "1u6pkny4hfb44gcso80o0g4kw84c0wocowso4o8kkgc44skosc"
}
```

2. Get token request:
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
3. Now to access to the Rest Api we must send token in request headers
```bash
Authorization: Bearer ZTFhMzlhNDRkNzg4ZjQ2MzQ5NzhhOTNkNGJjODYyNDgwZDdhMzUzMjYzMTMzOGY2ZTNkYzUzMTI2YmIyY2E1YQ
```

To add task using POST method:
http://<host>/api/task
Body:
```json
{
"name": "Some new task",
"description": "Some description"
}
```
To get all tasks using method GET:
http://<host>/api/tasks
Response will be something like this (if you have records):
[{
"id": 1,
"name": "Some task",
"description": "Some description"
},
{
"id": 2,
"name": "Some new task2",
"description": "Some description2"
}]

To get one task using method GET:
http://<host>/api/task/<task_number> ( example: http://somedomain.com/api/task/2 )
Response:
{
"id": 1,
"name": "Some task",
"description": "Some description"
}
or you'll get 404 error and a message:
{
"status": "error: not found"
}

To delete task using method DELETE:
http://<host>/api/task/<task_number> ( example: http://somedomain.com/api/task/2 )
Respose must be:
    
{
"status": "ok"
}

In some cases you can also get you'll get 404 error and a message:
```json
{
"status": "error: not found"
}
```
if you are trying to get or to delete a task that does not exist

or even this:
```json
{
"status": "error: bad request"
}
```
if you your request formatted in a wrong way
