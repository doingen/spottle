function AllChecked(){
  var check =  document.form.all.checked;

  for (var i=0; i<document.form.spot_id.length; i++){
    document.form.spot_id[i].checked = check;
  }
}