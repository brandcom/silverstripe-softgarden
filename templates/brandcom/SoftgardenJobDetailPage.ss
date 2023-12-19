<% include HeaderImage %>
$ElementalArea
<% with $Jobdetail %>    
    <section class="softgarden-detailpage" data-worktime="$workTimes" data-workExperience="$workExperiences" data-worlPlace="$geo_city" data-workStartDate="$jobStartDate" id="jobinfos">
            <h2 id="postingName" data-jobtitle="$externalPostingName" class="softgarden-detailpage__job-title"><span class="h4 primarycolor2">$externalPostingName</span></h2>
            <div class="softgarden-detailpage__posting-wrapper">
                $jobAdText.RAW
            </div>
            <div class="softgarden-detailpage__apply-button-area">
                <a href="$applyOnlineLink" class="softgarden-detailpage__apply-button"> Jetzt bewerben </a>
            </div>
    </section>
<% end_with %>

    <!-- <script type="application/ld+json">
        {
            "@context" : "https://schema.org/",
            "@type" : "JobPosting",
            "title" : "$Jobbezeichnung",
            "description" : "$Description",
            "datePosted" : "$Date",
            "employmentType" : "$EmploymentType",
            "hiringOrganization" : {
                "@type" : "Organization",
                "name" : "$SiteConfig.Company",
                "sameAs" : "https://$SiteConfig.Website/",
                "logo" : "https://$SiteConfig.Website/$SiteConfig.Logoheader.Link"
            },
            "jobLocation": {
                "@type": "Place",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "$SiteConfig.Strasse",
                    "addressLocality": "$SiteConfig.Stadt",
                    "addressRegion": "$SiteConfig.Bundesland",
                    "postalCode": "$SiteConfig.PLZ",
                    "addressCountry": "DE"
                }
            }
        }
    </script> -->
