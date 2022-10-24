@extends('layouts.layout')

@section('contents')
<script src="https://kit.fontawesome.com/99288424cc.js" crossorigin="anonymous"></script>
<title>{{$info->title}}</title>
<main>
  <div class="info__wrapper">
    <div class="info__title">
      @php
          $created = substr($info->created_at, 0, 10);
          $date = str_replace('-', ".", $created);
      @endphp
      <span>{{$date}}</span><br>
      <h2>{{$info->title}}</h2>
    </div>
    <div class="info__contents">
      <p>{{$info->text}}</p>
      <p>アリスは川辺でおねえさんのよこにすわって、なんにもすることがないのでとても退屈（たいくつ）しはじめていました。一、二回はおねえさんの読んでいる本をのぞいてみたけれど、そこには絵も会話もないのです。「絵や会話のない本なんて、なんの役にもたたないじゃないの」とアリスは思いました。</p>
      <p>そこでアリスは、頭のなかで、ひなぎくのくさりをつくったら楽しいだろうけれど、起きあがってひなぎくをつむのもめんどくさいし、どうしようかと考えていました（といっても、昼間で暑いし、とってもねむくて頭もまわらなかったので、これもたいへんだったのですが）。そこへいきなり、ピンクの目をした白うさぎが近くを走ってきたのです。それだけなら、そんなにめずらしいことでもありませんでした。さらにアリスとしては、そのうさぎが「どうしよう！　どうしよう！　ちこくしちゃうぞ！」とつぶやくのを聞いたときも、それがそんなにへんてこだとは思いませんでした（あとから考えてみたら、これも不思議に思うべきだったのですけれど、でもこのときには、それがごく自然なことに思えたのです）。でもそのうさぎがほんとうに、チョッキのポケットから懐中時計（かいちゅうどけい）をとりだしてそれをながめ、そしてまたあわててかけだしたとき、アリスもとびあがりました。というのも、チョッキのポケットなんかがあるうさぎはこれまで見たことがないし、そこからとりだす時計をもっているうさぎなんかも見たことないぞ、というのに急に気がついたからです。</p>
    </div>
    <div class="info__button">
        @if($info->id != 1)
          <a href="{{route('info.show', ['info_id' => $info->id-1])}}"><i class="fas fa-arrow-left"></i> 以前の記事へ</a>
        @endif
        @if($info->id != $latest->id)
          <a href="{{route('info.show', ['info_id' => $info->id+1])}}">次の記事へ <i class="fas fa-arrow-right"></i></a>
        @endif
      </div>
  </div>
</main>
@endsection