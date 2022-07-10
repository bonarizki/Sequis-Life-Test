i was created migration for database, just run commad "php artisan migrate" for database.
and i was created the php unit test, so u can test the API with command "php artisan test".
for error response i made a response {"failed" : true} for every single API was created before.

QUESTION 1
url : api/friend
method : post
parameter : {
  "requestor": "andy@example.com",
  "to": "john@example.com"
}


QUESTION 2
url : api/friend/{type}
method : patch
parameter : {
  "requestor": "andy@example.com",
  "to": "john@example.com"
}

*parameter type on url u can change with "accept" or "reject"
*type parameter will be status of request friend


QUESTION 3
url : api/friend/request/{email}
method : get
parameter : change parameter email on url with email user


QUESTION 4
url : friend/list/{email}
method : get
parameter : change parameter email on url with email user


QUESTION 5
url : api/friend-same
method : get
parameter : {
  "friends":[
    "andy@example.com",
    "john@example.com"
  ]
}

QUESTION 6
url : api/friend-block
method : patch
parameter {
  "requestor": "andy@example.com",
  "block": "john@example.com"
}




