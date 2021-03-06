define({ "api": [
  {
    "type": "post",
    "url": "/albums",
    "title": "Create New Album.",
    "name": "CreateNewAlbum",
    "group": "Album",
    "description": "<p>Create New Album. Administrator may create albums for all users, whereas photographers are accessible only their personal albums.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Album name.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{ \"name\" : \"Wedding\" }",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "POST: http://localhost/albums",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 201": [
          {
            "group": "Success 201",
            "type": "String",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>Album object in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created\n {\n \"name\": \"Wedding\",\n \"users_id\": \"3\",\n \"id\": \"13\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Album"
  },
  {
    "type": "delete",
    "url": "/albums/:id",
    "title": "Delete Album unique ID.",
    "name": "DeleteAlbum",
    "group": "Album",
    "description": "<p>Delete the user's album unique ID. Administrator delete albums all users, whereas photographers are accessible only their personal albums.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Albums unique ID.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "DELETE: http://localhost/albums/2",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 204": [
          {
            "group": "Success 204",
            "type": "String",
            "optional": false,
            "field": "NoContent",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Album"
  },
  {
    "type": "get",
    "url": "/albums/:id",
    "title": "Request Album unique ID.",
    "name": "GetAlbum",
    "group": "Album",
    "description": "<p>Returns the user's album unique ID. Administrator gets albums all users, whereas photographers are accessible only their personal albums.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Albums unique ID.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "GET: http://localhost/albums/2",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>Album object in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n  \"id\": \"1\",\n  \"users_id\": \"3\",\n  \"name\": \"Wedding\",\n  \"active\": 1,\n  \"created_at\": \"2016-04-08 18:56:02\",\n  \"modified_at\": \"2016-04-14 13:16:40\"\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Album"
  },
  {
    "type": "get",
    "url": "/albums",
    "title": "Request All Albums",
    "name": "GetAllAlbums",
    "group": "Album",
    "description": "<p>Returns the user's albums. Administrator gets albums all users, whereas photographers are accessible only their personal albums.</p>",
    "examples": [
      {
        "title": "Example usage:",
        "content": "GET: http://localhost/albums",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String[]",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>JSON objects The group of objects &quot;albums&quot; in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n  \"id\": \"1\",\n  \"users_id\": \"3\",\n  \"name\": \"Wedding\",\n  \"active\": 1,\n  \"created_at\": \"2016-04-08 18:56:02\",\n  \"modified_at\": \"2016-04-14 13:16:40\"\n  },\n  {\n  \"id\": \"7\",\n  \"users_id\": \"3\",\n  \"name\": \"New Year\",\n  \"active\": 1,\n  \"created_at\": \"2016-04-14 12:47:13\",\n  \"modified_at\": null\n  },\n  {\n   ..........\n   ..........\n   ..........\n  },\n  {\n   ..........\n   ..........\n   ..........\n  },",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Album"
  },
  {
    "type": "put",
    "url": "/albums/:id",
    "title": "Update Album unique ID.",
    "name": "UpdateAlbum",
    "group": "Album",
    "description": "<p>Update the user's album unique ID. Administrator update albums all users, whereas photographers are accessible only their personal albums.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Albums unique ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"name\" : \"Wedding\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "PUT: http://localhost/albums/2",
        "type": "http"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n  \"id\": \"2\",\n  \"users_id\": \"3\",\n  \"name\": \"Wedding\",\n  \"active\": 1,\n  \"created_at\": \"2016-04-08 18:56:02\",\n  \"modified_at\": \"2016-04-14 13:16:40\"\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Album"
  },
  {
    "type": "post",
    "url": "/albums/:id/images",
    "title": "Create New Images.",
    "name": "CreateNewImage",
    "group": "Images",
    "description": "<p>Create New Images.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "form-data",
            "optional": false,
            "field": "UploadForm[imageFile]",
            "description": "<p>image file.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{ \"UploadForm[imageFile]\" : \"../pic.jpg\" }",
          "type": "form-data"
        }
      ]
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "POST: http://localhost/albums/1/images",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 201": [
          {
            "group": "Success 201",
            "type": "String",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>Image data object in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created\n {\n     \"image\": \"http://tut_kakoito_URL_17\",\n     \"albums_id\": \"1\",\n     \"id\": \"18\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Image was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Images"
  },
  {
    "type": "delete",
    "url": "/albums/:id/images/:image_id",
    "title": "Delete Image unique ID.",
    "name": "DeleteImage",
    "group": "Images",
    "description": "<p>Delete the user's image unique ID.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Image unique ID.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "DELETE: http://localhost/albums/1/images/7",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 204": [
          {
            "group": "Success 204",
            "type": "String",
            "optional": false,
            "field": "NoContent",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Images"
  },
  {
    "type": "get",
    "url": "/albums/:id/images",
    "title": "Request All Images of album.",
    "name": "GetAllImages",
    "group": "Images",
    "description": "<p>Returns the images of albums. Administrator gets images all users, whereas photographers are accessible only their personal albums &amp; images.</p>",
    "examples": [
      {
        "title": "Example usage:",
        "content": "GET: http://localhost/albums/1/images",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String[]",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>JSON objects The group of objects &quot;images&quot; in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n     [\n      {\n        \"id\": \"7\",\n        \"albums_id\": \"1\",\n        \"image\": \"http://tut_kakoito_URL_7\",\n        \"created_at\": \"2016-04-21 08:35:02\"\n      },\n      {\n        \"id\": \"8\",\n        \"albums_id\": \"1\",\n        \"image\": \"http://tut_kakoito_URL_8\",\n        \"created_at\": \"2016-04-21 08:35:13\"\n      },\n      {\n        \"id\": \"9\",\n        \"albums_id\": \"1\",\n        \"image\": \"http://tut_kakoito_URL_9\",\n        \"created_at\": \"2016-04-21 08:35:26\"\n      },   \n      {\n       ..........\n       ..........\n       ..........\n      },\n      {\n       ..........\n       ..........\n       ..........\n      },\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Images was not found.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Images"
  },
  {
    "type": "get",
    "url": "/albums/:id/images/:image_id",
    "title": "Request Image unique ID.",
    "name": "GetImage",
    "group": "Images",
    "description": "<p>Returns the user's image unique ID. Administrator gets image all users, whereas photographers are accessible only their personal albums.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Albums unique ID.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "GET: http://localhost/albums/1/image/7",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>Album object in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n    \"id\": \"7\",\n    \"albums_id\": \"1\",\n    \"image\": \"http://tut_kakoito_URL_7\",\n    \"created_at\": \"2016-04-21 08:35:02\"\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Images"
  },
  {
    "type": "put",
    "url": "/albums/:id/images/:image_id",
    "title": "Update Image unique ID.",
    "name": "UpdateImage",
    "group": "Images",
    "description": "<p>Update the user's image unique ID.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Image unique ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"image\" : \"http://tut_kakoito_URL_7\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "PUT: http://localhost/albums/1/images/7",
        "type": "http"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n  {\n   \"id\": \"7\",\n   \"albums_id\": \"1\",\n   \"image\": \"http://tut_kakoito_URL_7\",\n   \"created_at\": \"2016-04-21 08:35:02\"\n  }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Album was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/AlbumsController.php",
    "groupTitle": "Images"
  },
  {
    "type": "post",
    "url": "/users",
    "title": "Create New Users.",
    "name": "CreateNewUsers",
    "group": "Users",
    "description": "<p>Create New Users. Administrator only may create users.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "role",
            "description": "<p>User role.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>User name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>User password.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"role\" : \"photographer\",\n \"name\" : \"Alex\",\n \"email\" : \"alexalex@mymail.ru\",\n \"password\" : \"12345alex\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "POST: http://localhost/users",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 201": [
          {
            "group": "Success 201",
            "type": "String",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>Users object in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 201 Created\n       {\n        \"role\": \"photographer\",\n        \"name\": \"Alex\",\n        \"email\": \"alexalex@mymail.ru\",\n        \"password\": \"12345alex\",\n        \"id\": \"7\"\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Users was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/UsersController.php",
    "groupTitle": "Users"
  },
  {
    "type": "delete",
    "url": "/users/:id",
    "title": "Delete User unique ID.",
    "name": "DeleteUsers",
    "group": "Users",
    "description": "<p>Delete the user's unique ID. Administrator delete all users, whereas photographers &amp; client are accessible only their personal data.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "DELETE: http://localhost/users/2",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 204": [
          {
            "group": "Success 204",
            "type": "String",
            "optional": false,
            "field": "NoContent",
            "description": ""
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 204 No Content",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Users was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/UsersController.php",
    "groupTitle": "Users"
  },
  {
    "type": "get",
    "url": "/users",
    "title": "Request All Users",
    "name": "GetAllUsers",
    "group": "Users",
    "description": "<p>Returns the user's. Administrator allow only</p>",
    "examples": [
      {
        "title": "Example usage:",
        "content": "GET: http://localhost/users",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String[]",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>JSON objects The group of objects &quot;users&quot; in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n \"id\": \"1\",\n \"role\": \"admin\",\n \"name\": \"Igor\",\n \"email\": \"admin@mymail.ru\",\n \"password\": \"00000\",\n \"phone\": \"0677015800\",\n \"modified_at\": \"2016-04-16 18:18:11\",\n \"created_at\": \"2016-04-08 18:52:14\"\n },\n {\n \"id\": \"2\",\n \"role\": \"client\",\n \"name\": \"Sergo\",\n \"email\": \"serg@mymail.ru\",\n \"password\": \"serg\",\n \"phone\": null,\n \"modified_at\": \"2016-04-13 21:24:01\",\n \"created_at\": \"2016-04-08 23:37:20\"\n },\n {\n   ..........\n   ..........\n   ..........\n },\n {\n   ..........\n   ..........\n   ..........\n },",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Users was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/UsersController.php",
    "groupTitle": "Users"
  },
  {
    "type": "get",
    "url": "/users/:id",
    "title": "Request Users unique ID.",
    "name": "GetUsers",
    "group": "Users",
    "description": "<p>Returns the user's data unique ID. Administrator gets all users data, other users role gets only personal data.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "GET: http://localhost/users/3",
        "type": "http"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "JSONobjects",
            "description": "<p>Users object in the format JSON.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": \"3\",\n     \"role\": \"photographer\",\n     \"name\": \"Alex\",\n     \"email\": \"alex@mymail.ru\",\n     \"password\": \"Alex\",\n     \"phone\": null,\n     \"modified_at\": \"2016-04-12 22:10:33\",\n     \"created_at\": \"2016-04-08 23:39:12\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Users was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/UsersController.php",
    "groupTitle": "Users"
  },
  {
    "type": "put",
    "url": "/users/:id",
    "title": "Update Users unique ID.",
    "name": "UpdateUsers",
    "group": "Users",
    "description": "<p>Update the user's unique ID. Administrator update users all users data, whereas photographers &amp; client are accessible only their personal data.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n \"password\" : \"alex12345\"\n}",
          "type": "json"
        }
      ]
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "PUT: http://localhost/users/3",
        "type": "http"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n {\n     \"id\": \"3\",\n     \"role\": \"photographer\",\n     \"name\": \"Alex\",\n     \"email\": \"alex@mymail.ru\",\n     \"password\": \"Alex\",\n     \"phone\": null,\n     \"modified_at\": \"2016-04-12 22:10:33\",\n     \"created_at\": \"2016-04-08 23:39:12\"\n }",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Unauthorized",
            "description": "<p>The <code>401</code> of the User not authorized.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "Forbidden",
            "description": "<p>The <code>403</code> You are not allowed to perform this action.</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "NotFound",
            "description": "<p>The <code>404</code> of the Users was not found.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 401 Unauthorized\n{\n \"name\": \"Unauthorized\",\n \"message\": \"You are requesting with an invalid credential.\",\n \"code\": 0,\n \"status\": 401,\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "../basic/controllers/UsersController.php",
    "groupTitle": "Users"
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "../basic/documentation/main.js",
    "group": "W__home_intersog_fotographer_my_www_basic_documentation_main_js",
    "groupTitle": "W__home_intersog_fotographer_my_www_basic_documentation_main_js",
    "name": ""
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "../basic/web/documentation/main.js",
    "group": "W__home_intersog_fotographer_my_www_basic_web_documentation_main_js",
    "groupTitle": "W__home_intersog_fotographer_my_www_basic_web_documentation_main_js",
    "name": ""
  }
] });
