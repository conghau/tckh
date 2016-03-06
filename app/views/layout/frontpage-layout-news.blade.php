@extends('../front-page')

@section('main_content')
<div class="col-md-4 fp-boxhline">
    <div class="fp-boxtitle"><a href="{{url('news/viewartilces/4')}}">{{$list_cat['cat_4']->catname}}</a></div>
    <div>
        <?php
            $cat = $list_cat['cat_4'];
            $total_articles = count($cat->articles_show);

            $i = 0;
            for ( $i; ($i < $num_article_summary) && ($total_articles > 0); $i++ ) {
                if ( !isset($cat->articles_show[$i]) || !$cat->articles_show[$i] ) continue;
        ?>
        <div>&nbsp;</div>
        <div class="news_title"><a href="{{ url('news/view/'.$cat->articles_show[$i]->title_seo) }}">{{ $cat->articles_show[$i]->title }}</a>
        <span class="news_postdate">({{ date('d/m/Y',$cat->articles_show[$i]->post_date) }})</span></div>
        <div>{{ $cat->articles_show[$i]->summary_html }}</div>
        <?php
            }
        ?>
    </div>
</div>
<div class="col-md-4 fp-boxhline">
    <div class="fp-boxtitle"><a href="{{url('news/viewartilces/5')}}">{{$list_cat['cat_5']->catname}}</a></div>
    <div>
        <?php
            $cat = $list_cat['cat_5'];
            $total_articles = count($cat->articles_show);

            $i = 0;
            for ( $i; ($i < $num_article_summary) && ($total_articles > 0); $i++ ) {
                if ( !isset($cat->articles_show[$i]) || !$cat->articles_show[$i] ) continue;
        ?>
        <div>&nbsp;</div>
        <div class="news_title"><a href="{{ url('news/view/'.$cat->articles_show[$i]->title_seo) }}">{{ $cat->articles_show[$i]->title }}</a>
        <span class="news_postdate">({{ date('d/m/Y',$cat->articles_show[$i]->post_date) }})</span></div>
        <div>{{ $cat->articles_show[$i]->summary_html }}</div>
        <?php
            }
        ?>
    </div>
</div>
<div class="col-md-4">
    <div class="fp-boxtitle"><a href="{{url('news/viewartilces/6')}}">{{$list_cat['cat_6']->catname}}</a></div>
    <div>
        <?php
            $cat = $list_cat['cat_6'];
            $total_articles = count($cat->articles_show);

            $i = 0;
            for ( $i; ($i < $num_article_summary) && ($total_articles > 0); $i++ ) {
                if ( !isset($cat->articles_show[$i]) || !$cat->articles_show[$i] ) continue;
        ?>
        <div>&nbsp;</div>
        <div class="news_title"><a href="{{ url('news/view/'.$cat->articles_show[$i]->title_seo) }}">{{ $cat->articles_show[$i]->title }}</a>
        <span class="news_postdate">({{ date('d/m/Y',$cat->articles_show[$i]->post_date) }})</span></div>
        <div>{{ $cat->articles_show[$i]->summary_html }}</div>
        <?php
            }
        ?>
    </div>
</div>
@stop