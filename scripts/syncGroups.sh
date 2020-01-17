#!/bin/bash

TOKEN=$(php -r 'print_r(getenv("API_TOKEN"));')

get=$(curl -X GET --header "Accept: */*" "https://www.master-7rqtwti-uxvp7twxlqviw.us-2.platformsh.site/api/groups")
echo "Response from server"
echo $get

post=$(curl -X POST -H "Accept: application/json" -H "Content-Type:application/json" --data "$(get)" "https://www.master-7rqtwti-kv4o25uprfhju.us-2.platformsh.site/api/syncGroups")
