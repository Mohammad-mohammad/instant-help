
<div class="container">
    <h1 class="page-title">Languages</h1>
</div>




<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->renderPartial('webroot.themes.default.views.site.user-profile-sidebar'); ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <form id="add-language-form">
                        <h4>Choose a Language:</h4>
                        <div class="form-group">
                            <select class="form-control" id="available-languages">
                            </select>
                        </div>

                        <input type="submit" id="add-language-btn" class="btn btn-primary" value="Save Changes">
                    </form>
                </div>

            </div>
            <br/>
            <div class="row">
                <div class="col-md-12" id="languages-list">
                </div>
            </div>
        </div>
    </div>
</div>



<div class="gap"></div>