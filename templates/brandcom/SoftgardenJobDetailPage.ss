<% include HeaderImage %>
    <section class="bc-softgarden__detailpage">
        <% with $Jobdetail %>
            <h2 >$externalPostingName</h2>
            <p>Arbeitszeitmodell: $workTimes</p>
            <p>Berufserfahrung: $workExperiences</p>
            <p>Ab: $jobStartDate</p>
            <p>Ort: $geo_name</p>
            <div class="posting-wrapper">
                $jobAdText.RAW
            </div>
            <div class="apply-button-area">
                <a href="$applyOnlineLink"> Jetzt bewerben </a>
            </div>
        <% end_with %>
    </section>