# API CRUD APP

## Craeted By : Mahmuod Abdelfadeil

## Domin : https://crud-api-test.000webhostapp.com/

### [Requests](#requests-detailes)
### [Responses](#responses-details)


### requests-detailes
| Function            | Path                           | Method         | Body                                   |
|---------------------|--------------------------------|----------------|----------------------------------------|
| register            | /api/auth/register.php         | POST           | name , email , password                |
| login               | /api/auth/login.php            | POST           | email , password                       |
| View profile        | /api/users/profile.php         | POST           | id_user                                |
| Delete the profile  | /api/users/delete.php          | POST           | token                                  |
| Edit the profile    | /api/users/edit.php            | POST           | token                                  |
| Update the profile  | /api/users/update.php          | POST           | toke  , name  ,  email                 |
| Update the password | /api/users/update-password.php | POST           | Token  , old_password , new_password   |
|  all posts          | /api/posts                     | POST \|\| GET  |                                        |
| post details        | /api/posts/show.php            | POST           | id_post                                |
| delete the post     | /api/posts/delete.php          | POST           | token  ,  id_post                      |
| create a new post   | /api/posts/create.php          | POST           | token , title , description            |
| Edit the post       | /api/posts/edit.php            | POST           | token , id_post                        |
| Update the post     | /api/posts/update.php          | POST           | token , id_post , title , description  |


<br>
<br>

## responses-details

#### register 
```json
{
    "status": 1,
    "message": "success",
    "data": {
        "id": "12",
        "name": "mahmoud",
        "email": "mahmoudhasan509@gmail.com"
    }
}
```

#### login 
```json
{
    "status": 1,
    "message": "success login",
    "data": {
        "id": "12",
        "name": "mahmoud",
        "email": "mahmoudhasan509@gmail.com",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJjcnVkLWFwaS10ZXN0LjAwMHdlYmhvc3RhcHAuY29tIiwiaWF0IjoxNjE2NDQ3NjcxLCJleHAiOjE2MTY0NTEyNzEsImF1ZCI6InVzZXJzQXBpIiwiZGF0YV91c2VyIjp7ImlkIjoiMTIiLCJuYW1lIjoibWFobW91ZCIsImVtYWlsIjoibWFobW91ZGhhc2FuNTA5QGdtYWlsLmNvbSJ9fQ.lOKrQEsQMvh8BbI6lk8PELcIfzansdGgORh25a0N_kyuaTmmKAXTJgoUlM4pnL7yZ8RpQvu72zAVLJjePpwnZQ"
    }
}
```


#### View Profile 
```json
{
    "status": 1,
    "message": "success",
    "data": {
        "user": {
            "id": "12",
            "name": "mahmoud",
            "email": "mahmoudhasan509@gmail.com"
        },
        "posts": []
    }
}
```


#### Delete the profile
```json
{
    "status": 1,
    "message": "Your account has been successfully deleted",
    "data": false
}
```
#### Edit the profile
```json
{
    "status": 1,
    "message": "success",
    "data": {
        "id": "12",
        "name": "mahmoud",
        "email": "mahmoudhasan509@gmail.com"
    }
}
```
#### Update the profile
```json
{
    "status": 1,
    "message": "Successfully updated",
    "data": false
}
```
#### Update the password
```json
{
    "status": 1,
    "message": "Password has been successfully updated",
    "data": false
}
```
#### all posts
```json
{
    "status": 1,
    "message": "success",
    "data": [
        {
            "created_by": "Leanne Graham",
            "user_id": "1",
            "title": "dolorem eum magni eos aperiam quia",
            "description": "ut aspernatur corporis harum nihil quis provident sequi\nmollitia nobis aliquid molestiae\nperspiciatis et ea nemo ab reprehenderit accusantium quas\nvoluptate dolores velit et doloremque molestiae",
            "post_id": "6"
        },
        {
            "created_by": "Leanne Graham",
            "user_id": "1",
            "title": "optio molestias id quia eum",
            "description": "quo et expedita modi cum officia vel magni\ndoloribus qui repudiandae\nvero nisi sit\nquos veniam quod sed accusamus veritatis error",
            "post_id": "10"
        }
    ]
}
```
#### post details
```json
{
    "status": 1,
    "message": "success",
    "data": {
        "created_by": "Nicholas Runolfsdottir V",
        "user_id": "8",
        "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
        "description": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto",
        "post_id": "1"
    }
}
```
#### delete the post
```json
{
    "status": 1,
    "message": "The post has been successfully deleted",
    "data": false
}
```
#### create a new post
```json
{
    "status": 1,
    "message": "success add post",
    "data": {
        "post_id": "101",
        "user_id": "12",
        "title": "test title ",
        "desription": "test description"
    }
}
```
#### Edit the post
```json
{
    "status": 1,
    "message": "success",
    "data": {
        "id": "101",
        "title": "test title",
        "description": "test description",
        "user_id": "12"
    }
}
```
#### Update the post
```json
{
    "status": 1,
    "message": "Successfully updated",
    "data": false
}
```




