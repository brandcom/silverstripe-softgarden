const username = "3f56dd8f-af52-40dc-a759-ad117216a171";
const password = "";
let headers = new Headers();
const base_url = "https://api.softgarden.io/api/rest/v3/frontend";
const channelID = "125411_extern";
const get_jobs = `jobslist/${channelID}`;

headers.set("Authorization", "Basic " + btoa(username + ":" + password));
headers.set("Content-Type", "application/json");

fetch(`${base_url}/${get_jobs}`, {
    method: "GET",
    headers: headers,
})
    .then((response) => response.json())
    .then((data) => {
        console.log(data.results);
        const data_array = data.results;

        for (let i = 0; i < data_array.length; i++) {
            let div = document.createElement("div");
            let jobTitle = document.createElement("h2");
            jobTitle.innerHTML = data_array[i].externalPostingName;
            jobTitle.classList.add("text-3xl");
            jobTitle.classList.add("font-bold");
            jobTitle.classList.add("underline");
            let jobDescr = document.createElement("div");
            jobDescr.innerHTML = data_array[i].jobAdText;
            div.appendChild(jobTitle);
            div.appendChild(jobDescr);
            document.getElementById("holder").appendChild(div);
        }
    });
