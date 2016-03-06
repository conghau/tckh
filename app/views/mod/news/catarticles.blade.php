@extends('front-page')

@section('main_content')
<div class="news_viewarticle_box">
    <div class="fp-boxtitle" style="text-align: left;border-radius: 4px 4px 0px 0px;">{{ $catinfo->catname }}</div>
    <div class="news_viewarticle_box_content">
        <div>
            <ul class="unstyled" style="padding-left:30px;">
                <?php foreach ( $list_articles as $article ) { ?>
                <li style="margin-top:10px">
                    <div class="caption">
                        <h4><a class="news_viewarticle_title" href="{{ url('news/view/') }}/{{ $article->title_seo }}">{{ $article->title }}</a>
                        <span class="news_postdate">({{ date('d/m/Y', $article->post_date) }})</span></h4>
                    </div>
                    <p style="padding-top:10px;">
                        <?php
                        if ( strlen($article->full_content_text) <= 300 ) print $article->full_content_text;
                        else {
                            $text = substr($article->full_content_text,0,300) . '...';
                            $rp = strrpos($text, ' ');
                            if ( $rp > 0 ) $text = substr($text, 0, $rp) . '...';
                            print $text;
                        }
                        ?>
                    </p>
                    <div align="right"><i><a style="color:#990000;" href="{{ url('news/view/'.$article->title_seo) }}">Xem tiếp &raquo;</a></i></div>
                    <hr class="mhr" />
                </li>
                <?php } ?>
            </ul>
            <div align="center">
                <?php
                $pager = $list_articles->links();
                if ( $pager == '' ) { }
                else print $pager;
                ?>
            </div>
        </div>
    </div>
</div>
@stop