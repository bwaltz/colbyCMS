const fetch = require("node-fetch");
const { URLSearchParams } = require("url");

const api_token =
    "V7kXbWSXms217FtGL6LlJH0mUsEJewp8MAL2uStx6PNck0JQWOSC7RXMkugb";
// construct the URL to post to a publication
const GET_URL =
    "https://www.master-7rqtwti-uxvp7twxlqviw.us-2.platformsh.site/api/groups";
// const POST_URL =
//     "https://www.dev-54ta5gq-kv4o25uprfhju.us-2.platformsh.site/api/syncGroups?api_token=PFKN9ugGWTqpQ3qwb8nf9YFr8MU1SPrAty7sxJgRQ5s2hAkl8JVAN6QIjHyu";
const POST_URL = `http://127.0.0.1:8000/api/syncGroups?api_token=${api_token}`;

function removeIds(element) {
    delete element.id;
    if (element.children) {
        let i;
        for (i = 0; i < element.children.length; i++) {
            removeIds(element.children[i]);
        }
    }

    return element;
}

async function execute() {
    const getResponse = await fetch(GET_URL);
    const groups = await getResponse.json();
    const params = new URLSearchParams();

    // const newGroups = removeIds(groups.groups[0]);
    // console.log(newGroups);
    // params.append(
    //     "api_token",
    //     "PFKN9ugGWTqpQ3qwb8nf9YFr8MU1SPrAty7sxJgRQ5s2hAkl8JVAN6QIjHyu"
    // );
    // params.append("groups", [newGroups]);
    // console.log(JSON.stringify(groups.groups));
    const postResponse = await fetch(POST_URL, {
        method: "POST",
        headers: {
            "Content-type": "application/json",
            Accept: "application/json",
            "Accept-Charset": "utf-8"
        },
        body: JSON.stringify({
            groups: groups.groups
        })
    });

    const messageData = await postResponse.json();
    console.log(messageData);
    // the API frequently returns 201
    if (postResponse.status !== 200 && postResponse.status !== 201) {
        console.error(`Invalid response status ${postResponse.status}.`);
        throw messageData;
    }
}

execute();
