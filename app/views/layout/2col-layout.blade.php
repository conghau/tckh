@extends( Input::has('popup') ? '../../master-index-popup' : (Input::has('blank') ? '../../master-index-blank' : '../../master-index') )

@section('main_content')
<div class="row">
    <div class="col-md-8">
        @yield('view_content')
    </div>
    <div class="col-md-4 right-zone">
        <?php
            $vanban_captruong_moinhat = VanBan::get_lastest_items_loaivb(8, Config::get('qlvb.lastest_items'));
        ?>
        <div class="headline"><h2>Văn bản cấp Trường mới</h2></div>
        <div>
            <ul class="unstyled">
            <?php
                foreach ( $vanban_captruong_moinhat as $vanban ) {
            ?>
                <li>
                    <div class="qlvb_list_item">
                        <a href="{{ url('qlvb/viewvb/'.$vanban->id) }}">
                        <?php
                            $ty = $vanban->trichyeu;
                        ?>
                        {{ $ty }}</a>
                        <div class="news_postdate">(Ngày đăng: {{ date('d/m/Y',$vanban->update_at) }})</div>
                    </div>
                </li>
            <?php
                }
            ?>
            </ul>
        </div>

        <?php
            $vanban_phapqui_moinhat = VanBan::get_lastest_items_loaivb(9, Config::get('qlvb.lastest_items'));
        ?>
        <div>&nbsp;</div>
        <div class="headline"><h2>Văn bản pháp quy mới</h2></div>
        <div>
            <ul class="unstyled">
            <?php
                foreach ( $vanban_phapqui_moinhat as $vanban ) {
            ?>
                <li>
                    <div class="qlvb_list_item">
                        <a href="{{ url('qlvb/viewvb/'.$vanban->id) }}">
                        <?php
                            $ty = '';
                            if ( strlen($vanban->trichyeu) > 100 ) {
                                $tmp = substr($vanban->trichyeu, 0, 100);
                                $lp = strrpos($tmp, ' ');
                                $ty = substr($tmp,0,$lp);
                            }
                            else $ty = $vanban->trichyeu;
                        ?>
                        {{ $ty }}</a>
                        <div class="news_postdate">(Ngày đăng: {{ date('d/m/Y H:i', $vanban->update_at) }})</div>
                    </div>
                </li>
            <?php
                }
            ?>
            </ul>
        </div>

        <?php
            // lay cac bai viet moi nhat
            $lastest_articles = Articles::get_lastest_articles(5);
            ?>
            <div class="headline" style="padding-top:20px;"><h2>Tin tức/Thông báo mới</h2></div>
                <div>
                    <ul class="unstyled">
                <?php foreach ( $lastest_articles as $a ) { ?>
                        <li class="box_lastest_news_li"><a href="{{ url('news/view/'.$a->title_seo) }}">{{ $a->title }}</a> <span class="news_postdate">({{ date('d/m/Y',$a->post_date) }})</span></li>
                <?php } ?>
                    </ul>
                </div>
            </div>
    </div>
</div>
@stop