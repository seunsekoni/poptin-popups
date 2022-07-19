fetchDomain();

/**
 * Get the source url where the script is being ran..
 * 
 * @returns string
 */
async function getSoureUrl() {
    let url = document.currentScript.src;
    return url;
}

/**
 * Get the domain id from the url.
 * 
 * @returns string
 */
async function getDomainId() {
    let url = new URL(await getSoureUrl());
    let domainId = url.searchParams.get('id')
    return domainId;
}

/**
 * Get the domain from the API.
 *
 * @returns Promise
 */
async function fetchDomain() {
    let domainId = await getDomainId();
    let popupsUrl = `https://intense-earth-73718.herokuapp.com/api/domains/${domainId}`;
    await fetch(popupsUrl, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }

    })
        .then(response => response.json())
        .then(data => {
            processAlerts(data);
        })
}

/**
 * Process the alerts from the API.
 * 
 * @param {object} response 
 * @returns callback
 */
async function processAlerts(response) {
    const { popups } = response.data;
    const { data } = response;
    const parseRegisteredDomain = stripUrl(data.top_level)

    let url = window.location.href;
    let domain = url.split('/')[2];

    if (domain !== parseRegisteredDomain) {
        alert('Domain is not registered. Process aborted!!!');
        return;
    }
    let flag = false;
    let strippedDomain = stripUrl(domain);
    let popupsToShow = [];
    popups.forEach(popup => {
        let text = popup.text;
        popup.rules.forEach(setting => {
            console.log(setting)
            if (setting.status) {
                if (setting.rule === 'pages end with' && pageEndsWith(setting.page)) {
                    if (!popupsToShow.includes(text)) popupsToShow.push(text)
                } else if (setting.rule === 'pages contain' && pageContains(setting.page)) {
                    if (!popupsToShow.includes(text)) popupsToShow.push(text)
                }
                else if (setting.rule === 'pages start with' && pageStartsWith(setting.page)) {
                    if (!popupsToShow.includes(text)) popupsToShow.push(text)
                }
                else if (setting.rule === 'specific page' && isSpecificPage(`${strippedDomain}/${setting.page}`)) {
                    if (!popupsToShow.includes(text)) popupsToShow.push(text)
                } else {
                    return;
                }
            }
        });
    });

    popupsToShow.forEach(popup => {
        alert(popup);
    });
}

/**
 * Handle the logic for checking if the page url contains the text
 * 
 * @param {string} text 
 * @returns boolean
 */
function pageContains(text) {
    return stripUrl(window.location.href).indexOf(text) > -1;
}

/**
 * Handle the logic for checking if the page url is the same as the popup text input
 * 
 * @param {string} url 
 * @returns boolean
 */
function isSpecificPage(url) {
    return stripUrl(window.location.href) === url;
}

/**
 * Handle the logic for checking if the page url starts with the text.
 * 
 * @param {string} text 
 * @returns boolean
 */
function pageStartsWith(text) {
    return stripUrl(window.location.href).split('/')[1] === text;
}

/**
 * Handle the logic for checking if the page url ends with the text.
 * 
 * @param {string} text 
 * @returns boolean
 */
function pageEndsWith(text) {
    return location.pathname.match(/[^/]*(?=\/*$)/)[0] === text;
}

/**
 * Handle the logic for stripping urls to only Top Level Domain names.
 * 
 * @param {string} url 
 * @returns boolean
 */
function stripUrl(url) {
    return url.replace(/^(https?:|http?:)\/\//, '');
}
