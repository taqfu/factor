<html>
<head>
    <title>
        Root Basis - Track Time Easily
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{asset('css.css')}}" rel="stylesheet">
    <script src="{{asset('jquery-1.12.3.min.js')}}"> </script>
    <script src="{{asset('js.js')}}"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">


    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '283859945312556',
          xfbml      : true,
          version    : 'v2.7'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
<!--{{Config::get('app.timezone')}}-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84919420-1', 'auto');
  ga('send', 'pageview');

</script>
@if (\Request::route()->getName()!="root")
    <div class='text-center'>
        <a target="_blank"  href="https://www.amazon.com/gp/product/0143126563/ref=as_li_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=0143126563&linkCode=as2&tag=aeazln-20&linkId=c161ede12a28c1b48bb0ecaddf3b0675"><img border="0" src="//ws-na.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=US&ASIN=0143126563&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL110_&tag=aeazln-20" ></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=aeazln-20&l=am2&o=1&a=0143126563" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
        <a target="_blank"  href="https://www.amazon.com/gp/product/0307465357/ref=as_li_tl?ie=UTF8&camp=1789&creative=9325&creativeASIN=0307465357&linkCode=as2&tag=aeazln-20&linkId=6c79dd451c0cfdef942f3af4dbe0689b"><img border="0" src="//ws-na.amazon-adsystem.com/widgets/q?_encoding=UTF8&MarketPlace=US&ASIN=0307465357&ServiceVersion=20070822&ID=AsinImage&WS=1&Format=_SL110_&tag=aeazln-20" ></a><img src="//ir-na.amazon-adsystem.com/e/ir?t=aeazln-20&l=am2&o=1&a=0307465357" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
        
    </div>
@endif
    @yield('content')
</body>
</html>
