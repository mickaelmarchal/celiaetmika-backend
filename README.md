Celiaetmika API Backend
==========================

This project relies on [API Platform](https://www.api-platform.com). See the project documentation for install instructions.


### Authentication

1 - Navigate to http://localhost/app_dev.php#!/User/postUserCollection

Create a new user, for example :

```
{
  "email": "test@example.com",
  "plaintextPassword": "test",
  "displayName": "test account"
}
```

2 - Send a POST request using postman for example, to http://localhost/app_dev.php/auth

```
{
  "username": "test@example.com",
  "password": "test"
}
```

You will obtain a token, for example :

```
{
    "token": "eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0QGV4YW1wbGUuY29tIiwiaWF0IjoxNDk4NDI2MTExLCJleHAiOjE0OTg0Mjk3MTF9.T_BNPd2WBxaShVhZK5fOtpXtWwtWKkWbjXlkpqt0ds90HdG-hZa-WW8X7qGvQANk1XdvExYzOY9Xkr6R_npUnP7INBpHk37raH5-Z0bnDsdNmFbN2drNU689szYw7AO1oRbHb1fCkc1I1p_NI8NDBUJnhetWKg2R8zJB5ve_Jdnil4eJA34WO2WHZfBhwVLgXKhYz1gZwju7vtkSx7f_izK0BsDOb27Ico4XEU1XlfbtiOIE0Ji4gBM8-HRagGX1UMkRcjD1LArydkucX_BSErXb4Aynu1hRQ00vwsfx0JYf3oQoh1BBHnKBsm0y3_vh_s1JG2KfYURRIvudGFkzWecgyvA4h-KulyheJJ_Dj7t9gTrITWL9m7_ds96fFewUIIx4qprc_YIKVkaZVerVEFGOkM_t2rTfJ7zdHqlHVn1pEaHuXbrwje7uOWi4L_b_BC9VM6F2UXojjSceS2_omxNIuIgnj1sCweBezXEgNdwnyyaAw0uOK6uviOxi6I0lwemww4ehz-pYQUH6b0Nc44ZtkMPJJ1J-Oiq4ZDPkCy4gt60K-yxr6CNanMrbhcEyjFE6W_UX_2_HNpZ-1_fLbDHTMeuqR9p7vDc4OVquUwC42VcFH1Gip6dO4-V435JZ0gqfrPZCGd-B22ZUWEtOl7W7w0ByX3IOTGboWCGHRrQ"
}
```


3 - Embed this token in all your requests, in "Authorization" HTTP Header :

```
GET /app_dev.php/users HTTP/1.1
Host: localhost
Authorization: Bearer: eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJ0ZXN0QGV4YW1wbGUuY29tIiwiaWF0IjoxNDk4NDI2MTExLCJleHAiOjE0OTg0Mjk3MTF9.T_BNPd2WBxaShVhZK5fOtpXtWwtWKkWbjXlkpqt0ds90HdG-hZa-WW8X7qGvQANk1XdvExYzOY9Xkr6R_npUnP7INBpHk37raH5-Z0bnDsdNmFbN2drNU689szYw7AO1oRbHb1fCkc1I1p_NI8NDBUJnhetWKg2R8zJB5ve_Jdnil4eJA34WO2WHZfBhwVLgXKhYz1gZwju7vtkSx7f_izK0BsDOb27Ico4XEU1XlfbtiOIE0Ji4gBM8-HRagGX1UMkRcjD1LArydkucX_BSErXb4Aynu1hRQ00vwsfx0JYf3oQoh1BBHnKBsm0y3_vh_s1JG2KfYURRIvudGFkzWecgyvA4h-KulyheJJ_Dj7t9gTrITWL9m7_ds96fFewUIIx4qprc_YIKVkaZVerVEFGOkM_t2rTfJ7zdHqlHVn1pEaHuXbrwje7uOWi4L_b_BC9VM6F2UXojjSceS2_omxNIuIgnj1sCweBezXEgNdwnyyaAw0uOK6uviOxi6I0lwemww4ehz-pYQUH6b0Nc44ZtkMPJJ1J-Oiq4ZDPkCy4gt60K-yxr6CNanMrbhcEyjFE6W_UX_2_HNpZ-1_fLbDHTMeuqR9p7vDc4OVquUwC42VcFH1Gip6dO4-V435JZ0gqfrPZCGd-B22ZUWEtOl7W7w0ByX3IOTGboWCGHRrQ
Cache-Control: no-cache
```
