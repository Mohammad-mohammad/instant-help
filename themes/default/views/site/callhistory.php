<div class="container">
    <h1 class="page-title">Call's History</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->renderPartial('webroot.themes.default.views.site.user-profile-sidebar'); ?>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered table-striped table-booking-history">
                <thead>
                <tr>
                    <th>Out/In Call</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Rating(of 5)</th>
                    <?php /*<th>Another Field</th>
                    <th>Delete</th>*/ ?>
                </tr>
                </thead>
                <tbody id="call-history-table">
                <?php /*<tr>
                    <td class="booking-history-type"><i class="fa fa-level-down red-color"></i><small class="red-color">Incoming</small>
                    </td>
                    <td class="booking-history-title">fname1 lname1</td>
                    <td>Audio</td>
                    <td>4/12/2014</td>
                    <td>4/25/2014</td>
                    <td>$350</td>
                    <td class="text-center"><i class="fa fa-check"></i>
                    </td>
                    <td class="text-center"><a class="btn btn-default btn-sm" href="#">Delete</a>
                    </td>
                </tr>*/ ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<div class="gap"></div>
