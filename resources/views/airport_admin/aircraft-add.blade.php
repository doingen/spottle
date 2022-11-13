
<div class="aa_add__wrapper">
  <h2>航空機追加</h2>
  <div class="aa_add__outer">
    <form method="post" action="{{route('airport_admin.add_aircraft')}}" >
    @csrf
      <div class="aa_add__inner">
        <span>航空機名：</span>
        <input type="text" name="name">
      </div>
      <div class="aa_add__inner">
        @foreach($spots as $key=>$spot)
          <input type="checkbox" name="spot_id[]" id="key{{$key}}" value="{{$spot->id}}">
          <label for="key{{$key}}">{{$spot->name}}</label>
        @endforeach
      </div>
      <button>追加</button>
    </form>
  </div>
</div>