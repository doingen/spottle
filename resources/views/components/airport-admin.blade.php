<div class="aa__wrapper">
  <div class="aa_add__outer">
    <h2>{{$title}}</h2>
    <form method="post" action="{{$route}}" >
    @csrf
      <div class="aa_add__inner">
        {{$contents}}
      </div>
      {{$button}}
    </form>
  </div>
</div>