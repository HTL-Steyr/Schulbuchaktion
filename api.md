# API

- SCRUM -> first make a simple version, then implement the harder featuResponse
  - filters late
  - API for Creating/Updating adn the moneylist will be defined later

## POST /user/login
Request body
```json
{
  "username": "string",
  "password": "string"
}
```
Response body
```json
{
  "token": "string"
}
```

**Überall ab hier:**
Request headers
```json
{
  "Authorization": "Bearer XXX"
}
```

## GET /user/getme
Response body
```json
{
  // User object matching authorization header
}
```

## GET /orderlist
Request query parameters
```json
{
  "schoolyear": "string" // default current
}
```
Response body
```json
{
  "schoolyear": "string",
  "row": [
      {
          "rowId": "int",
          "book": {
              // Book object
          },
          "orderedFor": [
              {
                  // SchoolClass Object
              }
          ]
      }
  ]
}
```

## GET /subjects/:?id
Response body
```json
[
  {
      // Subject object
  }
]
```

## GET /departments/:?id
Response body
```json
[
  {
      // Department object
  }
]
```

## GET /schoolclass/:?id
Response body
```json
[
  {
      // SchoolClass object
  }
]
```

## ? /xls/orderlist
Request
```json
// orderlist.xls
```

## ? /xls/prices
Request
```json
// prices.xls
```

## GET /moneylist
Response body
```json
{
  // TBD
}
```