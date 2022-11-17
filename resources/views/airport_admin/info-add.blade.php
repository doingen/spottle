@extends('layouts.airport_admin')

@section('contents')
<title>インフォメーション追加</title>
<div class="aa_add__wrapper">
  <div class="aa_add__outer">
  @error('title')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('text')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('success'))
    <p class="aa__alert aa__notice">{{session('success')}}</p>
  @endif
    <h2 class="aa__page-title">インフォメーション追加</h2>
    <form method="post" action="{{route('airport_admin.add_info')}}" >
    @csrf
      <div class="aa_add__inner aa_add__info">
        <span>タイトル</span>
        <input type="text" name="title">
        <p>※50文字以内</p>
      </div>
      <div class="aa_add__inner aa_add__info">
        <span>内容</span>
        <textarea name="text" rows="10"></textarea>
      </div>
      <button>追加</button>
    </form>
  </div>
  <div class="aa_add__outer">
  @error('changed_title')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @error('changed_text')
    <p class="aa__alert">{{$message}}</p>
  @enderror
  @if(session('changed_success'))
    <p class="aa__alert aa__notice">{{session('changed_success')}}</p>
  @endif
  @if(session('changed_error'))
    <p class="aa__alert aa__notice">{{session('changed_error')}}</p>
  @endif
    <h2 class="aa_page-title">インフォメーション追加</h2>
    <form method="get" action="{{route('airport_admin.change_info')}}" >
      @csrf
      <div class="aa_add__inner aa_add__info">
        <span>変更インフォメーション</span>
        <select name="changed_info_id">
          @foreach($info as $info)
            <option value="{{$info->id}}" 
            @isset($selected_info) @if($selected_info->id == $info->id) selected 
            @endif @endisset>{{$info->title}}</option>
          @endforeach
        </select>
        <button class="aa_change__button">表示</button>
      </div>
    </form>
    <form method="post" action="{{route('airport_admin.change_info')}}">
      @csrf
      <div class="aa_add__inner aa_add__info">
        <span>タイトル</span>
        <input type="text" name="changed_title" @isset($selected_info) value="{{$selected_info->title}}" @endisset>
        <p>※50文字以内</p>
      </div>
      <div class="aa_add__inner aa_add__info">
        <span>内容</span>
        <textarea name="changed_text" rows="10">@isset($selected_info) {{$selected_info->text}} @endisset</textarea>
      </div>
      @isset($selected_info)
        <input type="hidden" name="changed_info_id" value="{{$selected_info->id}}">
      @endisset
      <button>変更</button>
    </form>
  </div>
</div>
@endsection