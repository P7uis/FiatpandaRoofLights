function _(el) {
  return document.getElementById(el);
}
function uploadFile(id) {
  var file = _(id).files[0];
  // alert(file.name+" | "+file.size+" | "+file.type);
  var formdata = new FormData();
  formdata.append(id, file);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "submit.php");
  ajax.send(formdata);
}

function progressHandler(event) {
  var percent = (event.loaded / event.total) * 100;
  _("progressBar").value = Math.round(percent);
}

function completeHandler(event) {
  _("progressBar").value = 0;
  $("#content").load("get.php");
}

function errorHandler(event) {
}

function abortHandler(event) {
}
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
function refreshLight(){
  console.log("refreshing button");
  $("#lightbtnnav").load("/jqueryloadbtn.php");
}
function refreshCell(){
  console.log("refreshing cells");
  $('.carousel-cell').each(function () {
    if(this.id == "ignore"){}
    else {
      //console.log("refreshed #"+this.id);
      $("#"+this.id).load("jqueryloadcell.php?id="+this.id);
    }
  });
}
function appendText(profile) {
  var lastrow = parseInt($('#max' + profile).val())
  var newrow = lastrow + 1;
  if (lastrow == 0 || rowchecker(profile)) {
    $('#max' + profile).val(newrow);
    var checkboxrow = '<div id="checkboxrow' + newrow + '" class="input-group mb-1"><div class="input-group-prepend"><div class="input-group-text alt-input-style"><input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '0" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '1" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '2" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '3" class="profilecheck">&ensp;<input type="checkbox" onchange="appendText(' + profile + ')" value="1" name="profile' + profile + newrow + '4" class="profilecheck">&ensp;</div></div><input type="number" required min="0.05" max="60" step="0.05" name="delay' + newrow + '" value="0.25" class="form-control delay' + profile + ' input-style" placeholder="delay"></div>';
    $("#checkboxrows" + profile).append(checkboxrow); // Append new elements
  }
}

function rowchecker(profile) {
  while (true) {
    var lastrow = parseInt($('#max' + profile).val())
    var secondlastrow = lastrow - 1;
    var lastcheck = false;
    for (var i = 0; i < 5; i++) {
      if ($('[name="profile' + profile + parseInt(lastrow) + i + '"]').is(':checked')) {
        lastcheck = true;
        break;
      }
    }

    var secondlastcheck = false;
    for (var i = 0; i < 5; i++) {
      if ($('[name="profile' + profile + secondlastrow + i + '"]').is(':checked')) {
        secondlastcheck = true;
        break;
      }
    }
    if (secondlastcheck) {
      if (lastcheck) {
        return true;
      } else {
        //do nothing
        return false;
      }
    } else {
      if (lastrow == 0) return false;
      else {
        $('#max' + profile).val(parseInt(lastrow) - 1);
        $("#checkboxrow" + lastrow).remove();
      }
    }
  }
}

function DelayChanger(profile) {
  var lastrow = parseInt($('#max' + profile).val())
  delay = $('#alldelay' + profile).val();
  console.log(delay);
  $('.delay' + profile).val(delay);
}
