
<div class="container">
    <h1 class="page-title">Competences</h1>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->renderPartial('webroot.themes.default.views.site.user-profile-sidebar'); ?>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <form id="add-competence-form">
                        <h4>Choose a competence:</h4>
                        <div class="form-group">
                            <select class="form-control" id="available-competences">
                            </select>
                        </div>

                        <input type="submit" id="add-competence-btn" class="btn btn-primary" value="Save Changes">
                    </form>
                </div>

            </div>
            <br/>
            <div class="row">
                <div class="col-md-12" id="competences-list">
                </div>
            </div>
        </div>
    </div>
</div>



<div class="gap"></div>
