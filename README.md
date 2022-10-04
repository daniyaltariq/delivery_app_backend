# code_challange_2_backend

### `How to run this project locally`
1. install [Xampp](https://www.apachefriends.org/)
2. clone this project in `C:\xampp\htdocs`
3. run the `xampp control panel`
4. start `Apache` and `MYSQL`
5. click on admin button in front of MYSQL
6. phpMyAdmin site will open in browser there create a new db named as `backend_db`
7. import the SQL file located in cloned project root folder in phpMyAdmin
8. run the frontend and enjoy.

### Scope
I have used `OOP` concept to create classes for models and use them in APIs. I have also used `PDO` class that represents a connection between PHP and a database server. `JWt` token can also be used for auth but currently for the shortage of time I didn't use it.

These are some APIs mentioned bellow which is being used throught our current application but still there's room for improvements like (use status codes in error handling and etc).

1. POST `http://localhost/code_challange_2/api/user/auth.php`
> payload:
```
{
  "email": "admin@admin.com"
  "password": "admin"
}
```
2. GET `http://localhost/code_challange_2/api/user/readDispatcher.php`
3. GET `http://localhost/code_challange_2/api/user/read.php`
4. POST `http://localhost/code_challange_2/api/parcel/read.php`
> payload:
```
{
  "id": "1"
}
```

5. POST `http://localhost/code_challange_2/api/parcel/create.php`
> payload:
```
{
  "id": "1233434687",
  "consignee_id": "2",
  "track_history": [
    {
      "status": "Parcel Added",
      "date": "10/3/2022, 8:17:01 PM"
    }
  ],
  "sending_location": "Pakistan",
  "receiving_location": "London",
  "creator": "1"
}
```

6. POST `http://localhost/code_challange_2/api/parcel/delete.php`
> payload:
```
{
  "id": "1233434687"
}
```

7. POST `http://localhost/code_challange_2/api/parcel_track_history/create.php`
> payload: 
```
{
  "parcelId": "1233434687",
  "status": "Picked Up",
  "date": "10/3/2022, 9:17:01 PM"
}
```
