
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
                    <form action="">
                        <h4>Choose a competence:</h4>
                        <div class="form-group">
                            <select class="form-control">
                                <option value="competence1">Competence1</option>
                                <option value="competence2">Competence2</option>
                                <option value="competence3">Competence3</option>
                                <option value="competence4">Competence4</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Save Changes">
                    </form>
                </div>

            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                        </button>
                        <p class="text-small">Competence1</p>
                    </div>
                    <div class="alert alert-info">
                        <button class="close" type="button" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                        </button>
                        <p class="text-small">Competence2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="gap"></div>
