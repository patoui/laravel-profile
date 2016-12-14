@extends('layouts.app')

@section('title', 'Cass &amp; Pat 2016')

@section('css')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<style type="text/css">
html, body {
    width: 100%;
    height: 100%;
}
div {
    height: 100%;
}
img {
    height:100%;
    width:auto;
    vertical-align: top;
    margin: 0 auto;
    background-color:grey;
}
@media (max-width: 500px) {
    img {
        height:auto;
        width:100%;
        vertical-align: top;
        margin: 0 auto;
        background-color:grey;
    }
}
.your-class {
    background-color: #f5f5f5;
}
#initial_message {
    height: 170px;
    max-height: 250px;
    transform: scale(0.8);
}
.popup_visible #initial_message {
    transform: scale(1);
}
.well {
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
    display: none;
    margin: 1em;
}
</style>
@endsection

@section('content')
<div id="initial_message" class="well" tabindex="-1">
    <h4>Cass &amp; Pat 2016 <i class="fa fa-heart" aria-hidden="true"></i></h4>
    <p>This is a page dedicated to love and affection that Patrique Ouimet has for Cassandra Druken</p>
    <div class="text-right">
        <button class="initial_message_close btn btn-default">Close</button>
    </div>
</div>
</div>
<div class="your-class">
  <div><img src="/img/cass-and-pat/2016/12466146_1629064104023898_2538377990927453607_o.jpg" alt="Cass and Pat 1"></div>
  <div><img src="/img/cass-and-pat/2016/12471913_1629064114023897_9184802343767358480_o.jpg" alt="Cass and Pat 2"></div>
  <div><img src="/img/cass-and-pat/2016/12523971_1647598478837127_1663480012660259609_n.jpg" alt="Cass and Pat 3"></div>
  <div><img src="/img/cass-and-pat/2016/13002373_1662695240660784_2995005258897929510_o.jpg" alt="Cass and Pat 4"></div>
  <div><img src="/img/cass-and-pat/2016/13076902_1118588831532774_3786703405598823543_n.jpg" alt="Cass and Pat 5"></div>
  <div><img src="/img/cass-and-pat/2016/13119090_1126671324020173_2780851649282898819_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13177786_1671460926450882_4167856486942037432_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13301501_1140343032653002_2298550305715020558_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13305023_1140343105986328_1671366649336608996_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13323215_1140343025986336_1230541607452512670_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13483139_1686720878258220_3357953101098287092_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13680118_10154379617411252_258686950120871667_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13906754_1183091631711475_925120248823058740_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13923638_1806011182961873_5107627345655372342_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13934766_1150686238308470_4534901840789581176_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/13937953_1806008556295469_4162927160768510977_o.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14039881_10207552541467363_81922032865898734_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14390635_1719053851691589_8540311398240842600_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14440771_10157489030110484_8516267914033723826_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14446063_1235027029851268_6002887996026520336_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14639888_1741508252779482_2775871376733642308_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14695475_1833619023539184_6181718856962717772_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/14717289_1833619056872514_1326605095967049648_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/15134529_1746849282245379_6300613154303501856_n.jpg" alt="Cass and Pat 6"></div>
  <div><img src="/img/cass-and-pat/2016/15369277_1305417739478863_3779941390782966358_o.jpg" alt="Cass and Pat 6"></div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-popup-overlay/1.7.9/jquery.popupoverlay.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.your-class').slick({
            accessibility: true,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            infinite: true,
            fade: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            lazyLoad: 'ondemand'
        });
        $('#initial_message').popup({
            autoopen: true,
            transition: 'all 0.3s'
        });
    });
</script>
@endsection