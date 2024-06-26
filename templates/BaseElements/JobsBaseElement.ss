<% require css("./vendor/brandcom/silverstripe-softgarden/client/dist/softgardenstyles.css") %>
<div class="bc-softgarden__job-base-element">
    <div class="bc-softgarden__job-base-element-container">
        <h3 class="bc-softgarden__job-base-element-headline">
            $Headline
        </h3>

        <% if $ShowStandortFilter %>
            <h3 class="h4 bc-softgarden__location-filter">Filter für Raum, Gebiet</h3>
            <select class="bc-softgarden__job-base-element-dropdown-locations">
                <option value="empty">Alle</option>
                <% loop $getGeoCities %>
                    <option value="$City">$City</option>
                <% end_loop %>
            </select>
        <% end_if %>

        <%-- Show Company Name --%>
        <% if $ShowCompanyName %>

            <div class="bc-softgarden__job-base-element-jobwrapper">
                <% if $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                    <div class="bc-softgarden__job-base-element-marker-wrapper">
                        <div class="bc-softgarden__job-base-element-marker-title"><p>Stellen&shy;bezeichnung</p></div>
                        <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__worktime"><p>Art</p></div>
                        <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__job-base-element-marker-title-last"><p><% if $ShowStandortFilter %>Ort <%end_if%></p></div>
                    </div>
                    <% if $ShowStandortFilter %>
                        <% loop $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                            <a href="jobdetails/showjob/$jobDbId" class="bc-softgarden__job-base-element-overlay-job" data-location="$geo_city">
                                <div class="bc-softgarden__job-base-element-third">
                                    <p class="bc-softgarden__job-base-element-p">$externalPostingName</p>
                                    <p class="bc-softgarden__job-base-element-p-worktime-mobile">$workTimes</p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__worktime">
                                    <p class="bc-softgarden__job-base-element-p">$workTimes &shy; <% if $jobStartDate %>- ab $jobStartDate <% else %>- AB SOFORT <% end_if %></p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__job-base-element-third-last">
                                    <p class="bc-softgarden__job-base-element-p bc-softgarden__job-base-element-location">$company_name - $geo_city</p>
                                </div>
                            </a>
                        <% end_loop %>
                    <% else %>
                        <% loop $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                            <a href="jobdetails/showjob/$jobDbId" class="bc-softgarden__job-base-element-overlay-job" data-EmploymentType="$employmentTypes">
                                <div class="bc-softgarden__job-base-element-third">
                                    <p class="bc-softgarden__job-base-element-p">$externalPostingName</p>
                                    <p class="bc-softgarden__job-base-element-p-worktime-mobile">$workTimes</p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__worktime">
                                    <p class="bc-softgarden__job-base-element-p">$workTimes &shy; <% if $jobStartDate %>- ab $jobStartDate <% else %>- AB SOFORT <% end_if %></p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__job-base-element-third-last">
                                    <p class="bc-softgarden__job-base-element-p bc-softgarden__job-base-element-location">$company_name</p>
                                </div>
                            </a>
                        <% end_loop %>
                    <% end_if %>
                <% else %>
                    <p>Aktuell sind keine offenen Stellen verfügbar</p>
                <% end_if %>
            </div>
             <%-- DONT Show Company Name --%>
        <% else %>
            <div class="bc-softgarden__job-base-element-jobwrapper">
                <% if $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                    <div class="bc-softgarden__job-base-element-marker-wrapper">
                        <div class="bc-softgarden__job-base-element-marker-title"><p>Stellen&shy;bezeichnung</p></div>
                        <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__worktime"><p>Art</p></div>
                        <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__job-base-element-marker-title-last"><p><% if $ShowStandortFilter %>Ort <%end_if%></p></div>
                    </div>
                    <% if $ShowStandortFilter %>
                        <% loop $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                            <a href="jobdetails/showjob/$jobDbId" class="bc-softgarden__job-base-element-overlay-job" data-location="$geo_city">
                                <div class="bc-softgarden__job-base-element-third">
                                    <p class="bc-softgarden__job-base-element-p">$externalPostingName</p>
                                    <p class="bc-softgarden__job-base-element-p-worktime-mobile">$workTimes</p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__worktime">
                                    <p class="bc-softgarden__job-base-element-p">$workTimes &shy; <% if $jobStartDate %>- ab $jobStartDate <% else %>- AB SOFORT <% end_if %></p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__job-base-element-third-last">
                                    <p class="bc-softgarden__job-base-element-p bc-softgarden__job-base-element-location">$geo_city</p>
                                </div>
                            </a>
                        <% end_loop %>
                    <% else %>
                        <% loop $getFilteredSoftgardenJobs($EmploymentTypeFilter) %>
                            <a href="jobdetails/showjob/$jobDbId" class="bc-softgarden__job-base-element-overlay-job" data-EmploymentType="$employmentTypes">
                                <div class="bc-softgarden__job-base-element-third">
                                    <p class="bc-softgarden__job-base-element-p">$externalPostingName</p>
                                    <p class="bc-softgarden__job-base-element-p-worktime-mobile">$workTimes</p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__worktime">
                                    <p class="bc-softgarden__job-base-element-p">$workTimes &shy; <% if $jobStartDate %>- ab $jobStartDate <% else %>- AB SOFORT <% end_if %></p>
                                </div>
                                <div class="bc-softgarden__job-base-element-third bc-softgarden__job-base-element-third-last">
                                    <p class="bc-softgarden__job-base-element-p arrow">Mehr erfahren</p>
                                </div>
                            </a>
                        <% end_loop %>
                    <% end_if %>
                <% else %>
                    <p>Aktuell sind keine offenen Stellen verfügbar</p>
                <% end_if %>
            </div>
        <% end_if %>
    </div>
</div>

