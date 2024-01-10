const job_name_label = document.getElementById("softgarden__job_name_label");
const job_info_label = document.getElementById("softgarden__job_infos_label");
const jobinfos = document.getElementById("jobinfos");
const posingtitle = document.getElementById("postingName");
const benefit_default_icon = './img/benefit_default.png';
const softgarden_be_benefits = document.getElementById(
    "softgarden_benefit_wrapper"
);

//* It is importand, that the naming is identical. 
//* the icons are located in the public->img->benefit_icons folder
const benefit_list = [
    {
        benefit: "Zukunftssicherer Arbeitsplatz",
        benefit_icon_url: "./img/benefit_icons/icons-zukunftssicher.png",
    },
    {
        benefit: "Geregelte Arbeitszeiten",
        benefit_icon_url: "./img/benefit_icons/arbeitszeiten.png",
    },
    {
        benefit: "Übertarifliche Bezahlung",
        benefit_icon_url: "./img/benefit_icons/bezahlung.png",
    },
    {
        benefit: "Erfolgsprämie",
        benefit_icon_url: "./img/benefit_icons/benefits.png",
    },
    {
        benefit: "Betriebliche Altersvorsorge",
        benefit_icon_url: "./img/benefit_icons/feiertagsarbeit.png",
    },
    {
        benefit: "Möglichkeiten zur Weiterbildung",
        benefit_icon_url: "./img/benefit_icons/icons-weiterbildung.png",
    },
    {
        benefit: "Möglichkeiten zur Weiterentwicklung",
        benefit_icon_url: "./img/benefit_icons/icons-weiterbildung.png",
    },
    {
        benefit: "Professionelle Arbeitsmaterialien und Arbeitskleidung",
        benefit_icon_url: "./img/benefit_icons/arbeitskleidung.png",
    },
    {
        benefit: "Professionelle Arbeitsmaterialien",
        benefit_icon_url: "./img/benefit_icons/arbeitskleidung.png",
    },
    {
        benefit: "Firmenfahrzeug",
        benefit_icon_url: "./img/benefit_icons/dienstfahrzeug.png",
    },
];

let job_benefits = [];

if (jobinfos) {

    //////////////////////////////////////////////
    //* Render Job title and Job Infos in Header
    //////////////////////////////////////////////
    const postingName = posingtitle.getAttribute("data-jobtitle");
    const work_times = jobinfos.getAttribute("data-worktime");
    const workStartDate = jobinfos.getAttribute("data-workStartDate");
    const workPlace = jobinfos.getAttribute("data-worlPlace");

    let infoLabelContent = ``;

    if (work_times !== "") {
        infoLabelContent = `${work_times}`;
    }
    if (workPlace !== "") {
        infoLabelContent = infoLabelContent + ` | ${workPlace}`;
    }
    if (workStartDate !== "") {
        infoLabelContent = infoLabelContent + ` | Ab ${workStartDate}`;
    }

    job_name_label.innerHTML = postingName;
    job_info_label.innerHTML = infoLabelContent;

    //////////////////////////////////////////////
    //* Add and Render Benefits
    //////////////////////////////////////////////
    if (softgarden_be_benefits) {

        //* Parse last ul-li tags into array and append to benefit
        try {
            //* Get the Data from the Div on detail Page, where the job Ad Text is rendered
            const softgardenJobContent = document.querySelector('.softgarden-detailpage__posting-wrapper').innerHTML;
            //* Get the last ul Tag and push li tags in liElements
            const liElements = extractLiElements(softgardenJobContent);
            //* Push the tags into the job benefit array 
            for (let i = 0; i < liElements.length; i++) {
                const benefitIndex = doesObjectExist(benefit_list, 'benefit', liElements[i]);
                if (benefitIndex !== -1) {
                    job_benefits.push({benefit: `${liElements[i]}`, benefit_icon_url: `${benefit_list[benefitIndex].benefit_icon_url}`})
                } else {
                    job_benefits.push({benefit: `${liElements[i]}`, benefit_icon_url: './img/benefit_default.png'})
                }
            }
            //* Render Benefits
            for (let i = 0; i < job_benefits.length; i++) {
                softgarden_benefit_adder(job_benefits, i);
            }
    
        } catch (error) {
            //console.log(error);
        }
    }

    //* Delete last Benefit UL
    //const softgardenJobConten2t = document.querySelector('.softgarden-detailpage__posting-wrapper').innerHTML;
    //removeLastUlElement(softgardenJobConten2t);
}

//* Func to check if benefit exists -- reusable helper func 
function doesObjectExist(array, propertyName, value) {
    for (let i = 0; i < array.length; i++) {
      //Transform values in uppercase to compare 
      const objValue = String(array[i][propertyName]).toUpperCase();
      const targetValue = String(value).toUpperCase();
      
      if (objValue === targetValue) {
        return i; // Return the index of the benefit if benefit is included
      }
    }
    return -1; // return -1 if benefit is not included
  }

//* Fuction to append benefits
function softgarden_benefit_adder(benefitArr, index) {
    let newBenefit = document.createElement("div");
    newBenefit.classList.add("softgarden-benefits__Textmodul_holder");
    newBenefit.classList.add("softgarden-benefits__ThirdWidth");
    newBenefit.setAttribute("data-animate", "");
    newBenefit.setAttribute("data-animation", "slideInUp");

    let newBenefitIcon = document.createElement("img");
    newBenefitIcon.src = benefitArr[index].benefit_icon_url;
    newBenefitIcon.classList.add("softgarden-benefits__OptionalIcon");

    let newBenefitTextWrapper = document.createElement("div");
    newBenefitTextWrapper.classList.add("softgarden-benefits__Text");

    let newBenefitText = document.createElement("p");
    let newBenefitTextSpan = document.createElement("span");
    newBenefitTextSpan.classList.add("h6");
    newBenefitTextSpan.innerText = benefitArr[index].benefit;
    newBenefitText.appendChild(newBenefitTextSpan);

    newBenefitTextWrapper.appendChild(newBenefitText);

    newBenefit.appendChild(newBenefitIcon);
    newBenefit.appendChild(newBenefitTextWrapper);
    softgarden_be_benefits.appendChild(newBenefit);
}

//* Fuction to extract last ul
function extractLiElements(htmlString) {
    // Use the DOMParser to parse the HTML string into a Document object
    const parser = new DOMParser();
    const doc = parser.parseFromString(htmlString, 'text/html');
    // Select the last ul element in the Document object
    const ulElement = doc.querySelector('ul:last-of-type');
    // If there is no ul element, return an empty array
    if (!ulElement) {
    return [];
    }
    // Extract all li elements from the ul element and return them as an array
    const liElements = Array.from(ulElement.querySelectorAll('li'));
    return liElements.map(li => li.innerText);
}

//* Fuction to delete last ul
function removeLastUlElement(htmlString) {
    // Use the DOMParser to parse the HTML string into a Document object
    const parser = new DOMParser();
    const doc = parser.parseFromString(htmlString, 'text/html');
  
    // Select all ul elements in the Document object
    const ulElements = Array.from(doc.querySelectorAll('ul'));
  
    // If there are no ul elements, return the original HTML string
    if (ulElements.length === 0) {
      return htmlString;
    }
  
    // Remove the last ul element from the list
    const lastUlElement = ulElements.pop();
  
    // Remove the last ul element from the document
    if (lastUlElement.parentNode) {
      lastUlElement.parentNode.removeChild(lastUlElement);
    }
  
    // Get the updated HTML string after removing the last ul element
    const updatedHtml = doc.body.innerHTML;
    document.querySelector('.softgarden-detailpage__posting-wrapper').innerHTML = updatedHtml;

}


