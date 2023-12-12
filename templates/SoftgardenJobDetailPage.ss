<% with $Jobdetail %>
    <h2>$externalPostingName</h2>
    <p>Arbeitszeitmodell: $workTimes</p>
    <p>Berufserfahrung: $workExperiences</p>
    <p>Ort: $geo_name</p>
    $jobAdText.RAW
    <a href="$applyOnlineLink">
        Jetzt bewerben
    </a>
<% end_with %>