<div class="bc-softgarden__job-base-element">
    <div class="bc-softgarden__job-base-element-container">
        <h3 class="bc-softgarden__job-base-element-headline">
            $Headline
        </h3>

        <div class="">
            <div href="" class="">
                <div class=""><p>Stellenbezeichnung</p></div>
                <div class=""><p>Art</p></div>
            </div>
            <% loop $AllSoftgardenJobs %>
                <a href="jobdetails/showjob/$ID" class="">
                    <div class="">
                        <p class="">$externalPostingName</p>
                    </div>
                    <div class="">
                        <p class="">$employmentTypes</p>
                    </div>
                    <div class="">
                        <p class="">Mehr erfahren</p>
                    </div>
                </a>
            <% end_loop %>
        </div>
    </div>
</div>