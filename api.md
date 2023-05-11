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

## Request

Authorization Header: Bearer Token

## Response

```json

```

<!-- FIXME: This route does not work the same -->
# /department/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json

```

# /moneylist/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
{
    "id": Integer,
    "year": Integer,
    "priceInclusiveEbook": Integer,
    "priceEbook": Integer,
    "priceEbookPlus": Integer
}
```

<!-- FIXME: This route currently has no data in it -->
# /orderlist/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json

```

# /read/xlsx

## Methods
POST

## Request

Authorization Header: Bearer Token

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

## Request

Authorization Header: Bearer Token

## Response

```json

```

<!-- FIXME: This route currently has no data in it -->
# /schoolclass/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json

```

# /subject

## Methods
GET

## Request

Authorization Header: Bearer Token

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

## Request

Authorization Header: Bearer Token

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

## Request

Authorization Header: Bearer Token

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
