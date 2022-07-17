fetchDomains();

async function getUrl() {
    let url = document.currentScript.src;
    // let urlArray = url.split("/");
    // console.log(urlArray);
    return url;
}

async function beginCommunication(){
    let url = new URL(await getUrl());
    let domainId = url.searchParams.get('id')
    console.log(domainId);
    return domainId;
}

async function fetchDomains(){
    let domainId = await beginCommunication();
    let popupsUrl = `http://localhost:8000/domains/${domainId}`;
    await fetch(popupsUrl, {
        method: 'GET',
        
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
}