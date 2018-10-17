<?php
$temp=Yii::app()->language == "en"?"/":"_rtl/";
$p=Yii::app()->theme->baseUrl.'/assets'.$temp;
?>

<div class="container">
    <h3 class="booking-title">320 user found who is can help you!</h3>
    <div class="row">
        <div class="col-md-3">
            <form class="booking-item-dates-change mb30">
                <div class="form-group form-group-icon-left"><i class="fa fa-map-marker input-icon input-icon-hightlight"></i>
                    <label>Where</label>
                    <input class="typeahead form-control" value="" placeholder="City, Hotel Name or U.S. Zip Code" type="text" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-puzzle-piece input-icon input-icon-hightlight"></i>
                    <label>Competence</label>
                    <select class="typeahead form-control">
                        <option value="v1">competence1</option>
                        <option value="v2">competence2</option>
                        <option value="v3">competence3</option>
                        <option value="v4">competence4</option>
                    </select>
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-language input-icon input-icon-hightlight"></i>
                    <label>Profile Language</label>
                    <select class="typeahead form-control">
                        <option value="v1">language1</option>
                        <option value="v2">language2</option>
                        <option value="v3">language3</option>
                        <option value="v4">language4</option>
                    </select>
                </div>
                <div class="form-group form-group-icon-left">
                    <label>Type of service</label>
                    <div class="checkbox-inline">
                        <label>
                            <input class="i-check" type="checkbox" />Free</label>
                    </div>
                    <div class="checkbox-inline">
                        <label>
                            <input class="i-check" type="checkbox" />Paid</label>
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

                <input class="btn btn-primary" type="submit" value="Upadte Search" />
            </form>

        </div>
        <div class="col-md-9">

            <ul class="booking-list">
                <li>
                    <a class="booking-item" href="#">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="booking-item-img-wrap">
                                    <img src="<?php echo $p; ?>img/400x300.png" alt="Image Alternative text" title="title" />
                                </div>
                                <div class="item-type">
                                    Expert
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="booking-item-rating">
                                    <ul class="icon-group booking-item-rating-stars">
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star"></i>
                                        </li>
                                        <li><i class="fa fa-star-half-empty"></i>
                                        </li>
                                    </ul><span class="booking-item-rating-number"><b >4.1</b> of 5</span>
                                </div>
                                <h5 class="booking-item-title">First-Name Last-Name</h5>
                                <p class="booking-item-address"><i class="fa fa-map-marker"></i> Kerekes utca, Budapest, Hungary </p>
                                <ul class="booking-item-features booking-item-features-rentals booking-item-features-sign">
                                    <li rel="tooltip" data-placement="top" title="Languages"><i class="fa fa-language"></i><span class="booking-item-feature-sign">x 2</span>
                                    </li>
                                    <li class="feature-content">English, Hungary </li>
                                    <li rel="tooltip" data-placement="top" title="Competence"><i class="fa fa-puzzle-piece"></i><span class="booking-item-feature-sign">x 2</span>
                                    </li>
                                    <li class="feature-content">Networking, Software development </li>
                                </ul>
                            </div>
                            <div class="col-md-3"><span class="booking-item-price">253</span><span>/received calls</span><span class="btn btn-primary">Call Now</span>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
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

            </div>

        </div>
    </div>
    <div class="gap"></div>
</div>
