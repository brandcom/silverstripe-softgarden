<div class="bc-softgarden__job-base-element">
    <div class="bc-softgarden__job-base-element-container">
        <h3 class="bc-softgarden__job-base-element-headline">
            $Headline
        </h3>
        <div class="bc-softgarden__job-base-element-jobwrapper">
            <div class="bc-softgarden__job-base-element-marker-wrapper">
                <div class="bc-softgarden__job-base-element-marker-title"><p>Stellen&shy;bezeichnung</p></div>
                <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__worktime"><p>Art</p></div>
                <div class="bc-softgarden__job-base-element-marker-title bc-softgarden__job-base-element-marker-title-last"><p></p></div>
            </div>
            <% loop $AllSoftgardenJobs %>
                <a href="jobdetails/showjob/$jobDbId" class="bc-softgarden__job-base-element-overlay-job">
                    <div class="bc-softgarden__job-base-element-third">
                        <p class="bc-softgarden__job-base-element-p">$externalPostingName</p>
                        <p class="bc-softgarden__job-base-element-p-worktime-mobile">$workTimes</p>
                    </div>
                    <div class="bc-softgarden__job-base-element-third bc-softgarden__worktime">
                        <p class="bc-softgarden__job-base-element-p">$workTimes &shy;- ab $jobStartDate</p>
                    </div>
                    <div class="bc-softgarden__job-base-element-third bc-softgarden__job-base-element-third-last">
                        <p class="bc-softgarden__job-base-element-p arrow">Mehr erfahren</p>
                    </div>
                </a>
            <% end_loop %>
        </div>
    </div>
</div>
