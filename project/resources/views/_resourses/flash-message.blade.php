@if ($message_tgo = Session::get('green'))
<div class="row alert_box">
  <div class="col s12 m12 white-text green darken-1" onclick="fcloseParent(this)">
        <p style="cursor:pointer;">{{ $message_tgo }}<strong class="close_alert"><i class="material-icons">close</i></strong></p>           
  </div>
</div>
@endif


@if ($message_tgo = Session::get('red'))
<div class="row alert_box">
  <div class="col s12 m12 white-text red darken-1" onclick="fcloseParent(this)">
        <p style="cursor:pointer;">{{ $message_tgo }}<strong class="close_alert"><i class="material-icons">close</i></strong></p>           
  </div>
</div>
@endif


@if ($message_tgo = Session::get('orange'))
<div class="row alert_box">
  <div class="col s12 m12 white-text orange darken-1" onclick="fcloseParent(this)">
        <p style="cursor:pointer;">{{ $message_tgo }}<strong class="close_alert"><i class="material-icons">close</i></strong></p>           
  </div>
</div>
@endif


@if ($message_tgo = Session::get('blue'))
<div class="row alert_box">
  <div class="col s12 m12 white-text blue darken-1" onclick="fcloseParent(this)">
        <p style="cursor:pointer;">{{ $message_tgo }}<strong class="close_alert"><i class="material-icons">close</i></strong></p>           
  </div>
</div>
@endif


@if ($errors->any())
<div class="row alert_box">
  <div class="col s12 m12 white-text yellow darken-1" onclick="fcloseParent(this)">
        <p style="cursor:pointer;">Please, check your data<strong class="close_alert"><i class="material-icons">close</i></strong></p>           
  </div>
</div>
@endif

@if ($message_tgo = Session::get('message_tgo'))
<div class="row alert_box">
  <div class="col s12 m12 white-text red darken-1" onclick="fcloseParent(this)">
      <p style="cursor:pointer;">{{ $message_tgo }}<strong class="close_alert">
        <i class="material-icons">close</i></strong></p>
  </div>
</div>
@endif
<script>
function fcloseParent(ele){
    ele.parentNode.parentNode.removeChild(ele.parentNode);
}
</script>