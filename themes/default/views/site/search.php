<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;
Yii::app()->clientScript->registerScriptFile($p . 'js/search.js', CClientScript::POS_END);
?>

<div class="container">
    <h3 id="result-summary" class="booking-title"></h3>
    <div class="row">
        <div class="col-md-3">
            <form class="booking-item-dates-change mb30">
                <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>
                    <label>Where</label>
                    <input id="filter-city" class="<?php /*typeahead*/ ?> form-control" value="" placeholder="City" type="text" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-puzzle-piece input-icon input-icon-hightlight"></i>
                    <label>Competence</label>
                    <select id="filter-competence" class="form-control">
                        <option value=''>All</option>
                        <?php
                        $allCompetence=Competence::model()->findAll();
                        foreach ($allCompetence as $comp){
                            echo "<option value='$comp->id'>$comp->name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-language input-icon input-icon-hightlight"></i>
                    <label>Profile Language</label>
                    <select id="filter-language" class="form-control">
                        <option value=''>All</option>
                        <?php
                        $allLanguages=Language::model()->findAll();
                        foreach ($allLanguages as $lang){
                            echo "<option value='$lang->id'>$lang->name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div id="filter-client-type" class="form-group form-group-icon-left">
                    <label>Type of service</label>
                    <div class="checkbox-inline">
                        <label><input name="filter-client-type[]" value="0" class="i-check" type="checkbox" />Free</label>
                    </div>
                    <div class="checkbox-inline">
                        <label><input name="filter-client-type[]" value="1" class="i-check" type="checkbox" />Paid</label>
                    </div>
                    <div class="gap gap-mini"></div>
                </div>

                <?php /*
                <div class="form-group form-group-icon-left">
                    <label>Quality of service</label>
                    <div class="checkbox-inline  checkbox-small">
                        <label>
                            <input class="i-check" type="checkbox" />1</label>
                    </div>
                    <div class="checkbox-inline  checkbox-small">
                        <label>
                            <input class="i-check" type="checkbox" />2</label>
                    </div>
                    <div class="checkbox-inline  checkbox-small">
                        <label>
                            <input class="i-check" type="checkbox" />3</label>
                    </div>
                    <div class="checkbox-inline  checkbox-small">
                        <label>
                            <input class="i-check" type="checkbox" />4</label>
                    </div>
                    <div class="checkbox-inline  checkbox-small">
                        <label>
                            <input class="i-check" type="checkbox" />5</label>
                    </div>
                    <div class="gap gap-mini"></div>
                </div> */ ?>

                <input id="search-btn" class="btn btn-primary" type="submit" value="Upadte Search" />
            </form>

        </div>
        <div class="col-md-9" id="search-list-parent">
            <ul id="search-list" class="booking-list">

            </ul>
            <?php /*
            <div class="row">
                <div class="col-md-12">
                    <p><small>320 user found who is can help you!. &nbsp;&nbsp;Showing 1 – 15</small>
                    </p>
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a>
                        </li>
                        <li><a href="#">2</a>
                        </li>
                        <li><a href="#">3</a>
                        </li>
                        <li><a href="#">4</a>
                        </li>
                        <li><a href="#">5</a>
                        </li>
                        <li><a href="#">6</a>
                        </li>
                        <li><a href="#">7</a>
                        </li>
                        <li class="dots">...</li>
                        <li><a href="#">43</a>
                        </li>
                        <li class="next"><a href="#">Next Page</a>
                        </li>
                    </ul>
                </div>

            </div> */ ?>

        </div>
    </div>
    <div class="gap"></div>
</div>
