# API

# /user/login

## Methods
POST

## Request

```json
{
  "email": "String",
  "password": "String"
}
```

## Response

```json
{
  "token": "String"
}
```

<!-- FIXME: This route does not work the same -->
# /department

## Methods
GET

## Response

```json

```

<!-- FIXME: This route does not work the same -->
# /department/{id}

## Methods
GET

## Response

```json

```

<!-- FIXME: This route currently has no data in it -->
# /moneylist/{id}

## Methods
GET

## Response

```json

```

<!-- FIXME: This route currently has no data in it -->
# /orderlist/{id}

## Methods
GET

## Response

```json

```

# /read/xlsx

## Methods
POST

## Request

As `form-data`:\
`key`: schoolBookList
`value`: official xlsx file from [schulbuchaktion.at](https://www.schulbuchaktion.at/schulbuchlisten.html)

## Response

Just a response code.


<!-- FIXME: This route currently has no data in it -->
# /schoolclass

## Methods
GET

## Response

```json

```

<!-- FIXME: This route currently has no data in it -->
# /schoolclass/{id}

## Methods
GET

## Response

```json

```

# /subject

## Methods
GET

## Response

```json
[
  {
    "id": Integer,
    "name": "String",
    "shortName": "String",
    "headOfSubject": {
      "id": Integer,
      "shortName": "String",
      "firstName": "String",
      "lastName": "String",
      "email": "String",
      "role": []
    }
  },
  {

  }
]
```

# /subject/{id}

## Methods
GET

## Response

```json
{
  "id": Integer,
  "name": "String",
  "shortName": "String",
  "headOfSubject": {
    "id": Integer,
    "shortName": "String",
    "firstName": "String",
    "lastName": "String",
    "email": "String",
    "role": []
  }
}
```

# /user/getme

## Methods
GET

## Response

```json
{
  "id": Integer,
  "shortName": "String",
  "firstName": "String",
  "lastName": "String",
  "email": "String",
  "role": {
    "id": Integer,
    "name": "String"
  }
}
```
