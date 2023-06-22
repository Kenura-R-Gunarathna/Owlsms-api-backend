# API #

API documentation and guide of the owlsms web app.

## 1. Creating a new user ##

Request method : `POST`

Request URL : `https://owlsms.com/api/v1/register`

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

Body ( Below is the json data to be send. ) : 

```
{
    "name":"Lisara",
    "email":"damsanalisara@gmail.com",
    "password":"20030630#Kenulysa"
}
```

## 2. Login to a admin / user ##

Request method : `POST`

Request URL : `https://owlsms.com/api/v1/login`

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

Body ( Below is the json data to be send. ) : 

```
{
    "email":"kenuragunarathna@gmail.com",
    "password":"20030630#Kenulysa"
}
```

## 3. Institutions ##

This is permited only for the admin accounts.

### Getting all institutions ###

Request method : `GET`

Request URL : `https://owlsms.com/api/v1/institutions`

for `Authorization` set the `Bearer Tokens` as the `token` you obtained.

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

### Getting a single institution ###

Request method : `GET`

Request URL : `https://owlsms.com/api/v1/institutions/{institution_id}`

for `Authorization` set the `Bearer Tokens` as the `token` you obtained.

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

### Insert new institutions ###

Body ( Below is the json data to be send. ) : 

Request method : `POST`

Request URL : `https://owlsms.com/api/v1/institutions`

for `Authorization` set the `Bearer Tokens` as the `token` you obtained.

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

Body ( Below is the json data to be send. ) : 

```
{
    "name":"Thurstan Collage",
    "email":"thurstancollage@gmail.com",
    "contact_number":"0765474796",
    "website":"https://thurstancollage.lk",
    "facebook_page":"https://facebook.com/thurstan-collage",
    "address_line_1":"528/H",
    "address_line_2":"Valihidha",
    "city":"Kaduwela",
    "country":"Sri Lanka"
}
```

### Update existing institutions ###

Body ( Below is the json data to be send. ) : 

Request method : `PUT`

Request URL : `https://owlsms.com/api/v1/institutions/{institution_id}`

for `Authorization` set the `Bearer Tokens` as the `token` you obtained.

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

Body ( Below is the json data to be send. ) : 

```
{
    "name":"Meusius Collage",
    "email":"meusiuscollage@gmail.com",
    "contact_number":"0777190590",
    "website":"https://meusiuscollage.lk",
    "facebook_page":"https://facebook.com/meusius-collage",
    "address_line_1":"34/A",
    "address_line_2":"Ella",
    "city":"Colombo",
    "country":"Sri Lanka"
}
```

### Remove existing institutions ###

Body ( Below is the json data to be send. ) : 

Request method : `DELETE`

Request URL : `https://owlsms.com/api/v1/institutions/{institution_id}`

for `Authorization` set the `Bearer Tokens` as the `token` you obtained.

Header ( Set header values to below. ) : 

```
Accept => application/json 

Content-Type => application/json 
```

## 3. Creating a new user ##
