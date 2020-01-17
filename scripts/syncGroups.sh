#!/bin/bash

TOKEN=$(php -r 'print_r(getenv("API_TOKEN"));')

# get=$(curl -X GET --header "Accept: */*" "https://www.master-7rqtwti-uxvp7twxlqviw.us-2.platformsh.site/api/groups")
# echo "Response from server"
# echo $get

# post=$(curl -X POST -H "Accept: application/json" -H "Content-Type:application/json" --data "$get" "https://www.dev-54ta5gq-kv4o25uprfhju.us-2.platformsh.site/api/syncGroups -F api_token=$TOKEN")
# echo $post
post=$(curl -X POST \
  https://www.dev-54ta5gq-kv4o25uprfhju.us-2.platformsh.site/api/syncGroups/ \
  -H 'Accept: */*' \
  -H 'Accept-Encoding: gzip, deflate' \
  -H 'Cache-Control: no-cache' \
  -H 'Connection: keep-alive' \
  -H 'Content-Length: 224' \
  -H 'Content-Type: multipart/form-data; boundary=--------------------------452862100425070881691052' \
  -H 'Host: www.dev-54ta5gq-kv4o25uprfhju.us-2.platformsh.site' \
  -H 'cache-control: no-cache' \
  -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW' \
  -F api_token=PFKN9ugGWTqpQ3qwb8nf9YFr8MU1SPrAty7sxJgRQ5s2hAkl8JVAN6QIjHyu)
  echo $post