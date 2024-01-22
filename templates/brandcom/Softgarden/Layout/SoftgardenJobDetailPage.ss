<% include HeaderImage %>
$ElementalArea
<div class="softgarden-benefits__BE_textmodul softgarden-benefits__BackgroundLightgray">
    <div class="softgarden-benefits__roundoverlay"></div>
    <div class="softgarden-benefits__container">
        <div class="Textmodul_holder" data-animate="" data-animation="slideInUp">
            <div class="Text"> 
                <h5><span class="h2 primarycolor2">Deine Benefits bei uns:</span></h5>
            </div>
        </div>
        <div class="softgarden-benefits__BE_textmodul_flex flex flex-wrap" id="softgarden_benefit_wrapper"></div>
    </div>
</div>

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


   <script type="application/ld+json">
        {
            "@context" : "https://schema.org/",
            "@type" : "JobPosting",
            "title" : "$externalPostingName",
            "description" : "$jobAdText",
            "datePosted" : "$postingLastUpdatedDate",
            "employmentType" : "$workTimes",
            "hiringOrganization" : {
                "@type" : "Organization",
                "name" : "$company_name",
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
    </script> 


<% end_with %>

<script>
    var jobBenefits = $getBenefitsJson.RAW;
</script>