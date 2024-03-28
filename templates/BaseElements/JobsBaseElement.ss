<% require css("./vendor/brandcom/silverstripe-softgarden/client/dist/softgardenstyles.css") %>
<div class="bc-softgarden__job-base-element">
    <div class="bc-softgarden__job-base-element-container">
        <h3 class="bc-softgarden__job-base-element-headline">
            $Headline
        </h3>
            <% if $ShowDropdown %>
                <select class="bc-softgarden__job-base-element-dropdown" onchange="filter_EmploymentType(this.value)"></select>
            <% end_if %>
        <div class="bc-softgarden__job-base-element-jobwrapper">
            <% if $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                <div class="bc-softgarden__job-base-element-marker-wrapper">
                    <div class="bc-softgarden__job-base-element-marker-title"><p>Stellen&shy;bezeichnung</p></div>
                    <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__worktime"><p>Art</p></div>
                    <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__job-base-element-marker-title-last"><p></p></div>
                </div>
                <% loop $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                    <a href="jobdetails/showjob/$jobDbId" class="bc-softgarden__job-base-element-overlay-job" data-EmploymentType="$employmentTypes">
                        <div class="bc-softgarden__job-base-element-third">
                            <p class="bc-softgarden__job-base-element-p">$externalPostingName</p>
                            <p class="bc-softgarden__job-base-element-p-worktime-mobile">$workTimes</p>
                        </div>
                        <div class="bc-softgarden__job-base-element-third bc-softgarden__worktime">
                            <p class="bc-softgarden__job-base-element-p">$workTimes &shy; <% if  $jobStartDate %>- ab $jobStartDate <% else %>- AB SOFORT <% end_if %></p>
                        </div>
                        <div class="bc-softgarden__job-base-element-third bc-softgarden__job-base-element-third-last">
                            <p class="bc-softgarden__job-base-element-p arrow">Mehr erfahren</p>
                        </div>
                    </a>
                <% end_loop %>
            <% else %>
                <p>Aktuell sind keine offenen Stellen verfügbar</p>
            <% end_if %>
        </div>
    </div>
</div>

<script>


    function filter_EmploymentType(EmploymentType) {
        const jobElements = document.querySelectorAll('.bc-softgarden__job-base-element-overlay-job');
        jobElements.forEach((jobElement) => {
            if (EmploymentType === 'all') {
                jobElement.style.display = 'flex';
            } else {
                const EmploymentTypeData = jobElement.getAttribute('data-EmploymentType');
                if (EmploymentTypeData === EmploymentType) {
                    jobElement.style.display = 'flex';
                } else {
                    jobElement.style.display = 'none';
                }
            }
        });
    }

    function setFilterOptions() {
        const dropdown = document.querySelector('.bc-softgarden__job-base-element-dropdown');
        const jobElements2 = document.querySelectorAll('.bc-softgarden__job-base-element-overlay-job');
        const employmentTypes = [];

        const option0 = document.createElement('option');
        option0.value = 'all';
        option0.text = 'Alle Anstellungsarten';
        dropdown.appendChild(option0);

        jobElements2.forEach((jobElement) => {
            const EmploymentTypeData = jobElement.getAttribute('data-EmploymentType');
            if (!employmentTypes.includes(EmploymentTypeData)) {
                employmentTypes.push(EmploymentTypeData);
            }
        });

        employmentTypes.forEach((employmentType) => {
            const option = document.createElement('option');
            option.value = employmentType;
            option.text = employmentType;
            dropdown.appendChild(option);
        });
    }
    setFilterOptions();

</script>
