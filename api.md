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

# /user/getall

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
[
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
  },
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
  },
  ...
]
```

# /book

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
[
    {
        "id": Integer,
        "bookNumber": Integer,
        "title": "String",
        "shortTitle": "String",
        "listType": Integer,
        "schoolForm": Integer,
        "info": "String",
        "ebook": Bool,
        "ebookPlus": Bool,
        "subject": {
            "id": Integer,
            "name": "String",
            "shortName": "String"
        },
        "publisher": {
            "id": Integer,
            "publisherNumber": Integer,
            "name": "String"
        },
        "schoolGrades": []
    },
    {
    
    }
]
```

# /department

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
        "budget": Integer,
        "usedBudget": Integer,
        "headOfDepartment": {
            "id": Integer,
            "shortName": "String",
            "firstName": "String",
            "lastName": "String",
            "email": "String",
            "role": []
        },
        "schoolClasses": [
            {
                "id": Integer,
                "name": "String",
                "grade": Integer,
                "studentAmount": Integer,
                "repAmount": Integer,
                "usedBudget": Integer,
                "budget": Integer,
                "year": Integer,
                "schoolForm": Integer
            },
            {
            
            }
        ]
    },
    {
    
    }
]
```

# /department/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
{
    "id": Integer,
    "name": "String",
    "budget": Integer,
    "usedBudget": Integer,
    "headOfDepartment": {
        "id": Integer,
        "shortName": "String",
        "firstName": "String",
        "lastName": "String",
        "email": "String",
        "role": []
    },
    "schoolClasses": [
        {
            "id": Integer,
            "name": "String",
            "grade": Integer,
            "studentAmount": Integer,
            "repAmount": Integer,
            "usedBudget": Integer,
            "budget": Integer,
            "year": Integer,
            "schoolForm": Integer
        },
        {
            "id": Integer,
            "name": "String",
            "grade": Integer,
            "studentAmount": Integer,
            "repAmount": Integer,
            "usedBudget": Integer,
            "budget": Integer,
            "year": Integer,
            "schoolForm": Integer
        }
    ]
}
```

## Response

Response Code: HTTP_OK: 200

# /moneylist

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
[
  {
      "id": Integer,
      "year": Integer,
      "priceInclusiveEbook": Integer,
      "priceEbook": Integer,
      "priceEbookPlus": Integer,
      "book": {
            "title": "String",
            "shortTitle": "String"
      }
  },
  {
  
  }
]
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
    "priceEbookPlus": Integer,
    "book": {
            "title": "String",
            "shortTitle": "String"
    }
}
```

# /moneylist/delete/{id}

## Methods
DELETE

## Request

Authorization Header: Bearer Token

## Response

Response Code: HTTP_OK: 200

# /moneylist/write

## Methods
POST

## Request

Authorization Header: Bearer Token
```json
{
    "year": Integer,
    "priceInclusiveEbook": Integer,
    "priceEbook": Integer,
    "priceEbookPlus": Integer,
    "book": Integer (book id)
}
```

## Response

Response Code: HTTP_OK: 200

# /orderlist

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
[
  {
      "id": Integer,
      "count": Integer,
      "ebook": Bool,
      "ebookPlus": Bool,
      "schoolClass": [],
      "book": [],
      "teacherCopy": Bool
  },
  {
  
  }
]
```

# /orderlist/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json
{
    "id": Integer,
    "count": Integer,
    "ebook": Bool,
    "ebookPlus": Bool,
    "schoolClass": [],
    "book": [],
    "teacherCopy": Bool
}
```

# /orderlist/delete/{id}

## Methods
DELETE

## Request

Authorization Header: Bearer Token

## Response

Response Code: HTTP_OK: 200

# /orderlist/write

## Methods
POST

## Request

Authorization Header: Bearer Token
```json
{
    "count": Integer,
    "price": Integer,
    "ebook": Integer,
    "ebookPlus": Integer,
    "teacherCopy": Integer,
    "schoolClass": Integer (schoolClass id),
    "book": Integer (book id)
}
```

## Response

Response Code: HTTP_OK: 200

# /orderlist/update/{id}

## Methods
PUT

## Request

Authorization Header: Bearer Token\
(Only specify fields that should be updated)
```json
{
    "count": Integer,
    "price": Integer,
    "ebook": Integer,
    "ebookPlus": Integer,
    "teacherCopy": Integer,
    "schoolClass": Integer (schoolClass id),
    "book": Integer (book id)
}
```

## Response

Response Code: HTTP_OK: 200

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

Response Code: HTTP_OK: 200


<!-- FIXME: This route is broken -->
# /schoolclass

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json

```

<!-- FIXME: This route is broken -->
# /schoolclass/{id}

## Methods
GET

## Request

Authorization Header: Bearer Token

## Response

```json

```

# /schoolclass/delete/{id}

## Methods
DELETE

## Request

Authorization Header: Bearer Token

## Response

Response Code: HTTP_OK: 200

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


